<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Requests\JobRequest;
use App\Http\Resources\JobResource;
use App\Models\Job;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;
use Illuminate\Support\Facades\Cache;
use AmrShawky\LaravelCurrency\Facade\Currency;
use App\Models\Establishment;
use App\Models\User;
use Illuminate\Support\Facades\Request as FacadesRequest;


class JobController extends Controller
{
    public function index()
    {


        if (!FacadesRequest::has('search')) {
            return response()->json(Job::with(['establishment:id,name'])->get());
        }


        //if not returned, URL should be like this
        //__________________________________________ 

        //--- ?search={always empty}&currency={EUR(default) or CHF}&lng={longitude}&lat={latitude}&distance={distance in km's}&contract_type={id:contract}&category={id:position}&start_date={date}&end_date={date}&min_range={integer}&max_range={integer}&period={string}&establishment_name={whatever user inputs:string}



        $baseCurrency = 1;

        $EUR_TO_CHF =  Currency::convert()
            ->from('EUR')
            ->to('CHF')
            ->get();


        $CHF_TO_EUR =  Currency::convert()
            ->from('CHF')
            ->to('EUR')
            ->get();




        if (!empty(request()->currency) && request()->currency == 'CHF') {
            $baseCurrency = $CHF_TO_EUR;
            if (!empty(request()->min_range)) {
                request()->min_range *= $baseCurrency;
            };
            if (!empty(request()->max_range)) {
                request()->max_range *= $baseCurrency;
            };
        };


        $coords = [request()->lng, request()->lat];
        $jobs = Job::query()
            //location filter
            ->when(
                !empty(request()->lng) && !empty(request()->lat) && !empty(request()->distance),
                function ($query) use ($coords) {
                    $query->select('*')
                        ->selectDistanceTo($coords)
                        ->withinDistanceTo($coords, ((request()->distance) * 1000));
                }
                //contract filter
            )->when(!empty(request()->contract_type), function ($query) {
                $query->where('type_of_contract', request()->contract_type);
                //category filter
            })->when(!empty(request()->category), function ($query) {
                $query->where('category', request()->category);
                //start date filter
            })->when(!empty(request()->start_date) && empty(request()->end_date), function ($query) {
                $query->whereDate('start_date', '<=', request()->start_date);
                //start-end date filter
            })->when(!empty(request()->start_date) && !empty(request()->end_date), function ($query) {
                $query->whereDate('start_date', '<=', request()->start_date)->whereDate('end_data', '>=', request()->end_date);
                //min-max range filter
            })->when(!empty(request()->min_range) && !empty(request()->max_range), function ($query) {
                $query->whereBetween('salary', [request()->min_range, request()->max_range]);
                //min range filter
            })->when(!empty(request()->min_range) && empty(request()->max_range), function ($query) {
                $query->where('salary', '<=', request()->min_range);
                //max range filter
            })->when(!empty(request()->max_range) && empty(request()->min_range), function ($query) {
                $query->where('salary', '>=', request()->max_range);
                //period filter
            })->when(!empty(request()->period), function ($query) {
                $query->where('period_type', '=', request()->period);
                //text filter
            })->when(!empty(request()->establishment_name), function ($query) {
                // $query->join('establishments', 'jobs.establishment_id', '=', 'establishments.id', function())
                $query->join('establishments', 'jobs.establishment_id', '=', 'establishments.id');
            })
            ->when(!empty(request()->establishment_name), function ($query) {
                collect(explode(' ', request()->establishment_name))->filter()->each(function ($term) use ($query) {
                    $term = '%' . $term . '%';

                    $query->where('name', 'like', $term);
                });
            })
            ->get()
            ->makeHidden(['number_of_employees', 'industry', 'address', 'city', 'country', 'logo']);

        return response()->json(['filtered_jobs' => $jobs]);
    }


    /**
     * @throws AuthorizationException
     */
    public function store(JobRequest $request): JobResource
    {
        $this->authorize('recruiter', Auth()->user());

        $ad = Job::create($request->validated());
        JobResource::createImages($ad, $request);

        return JobResource::make($ad);
    }

    public function show(Job $job): JobResource
    {
        return JobResource::make($job);
    }

    /**
     * @throws AuthorizationException
     */
    public function update(Job $job, JobRequest $request): JobResource
    {
        $this->authorize('recruiter', Auth()->user());

        $updated = $job->update($request->validated());

        return JobResource::make($updated);
    }

    /**
     * @throws AuthorizationException
     */
    public function destroy(Job $job): AnonymousResourceCollection
    {
        $this->authorize('recruiter', Auth()->user());

        $job->delete();

        return JobResource::collection(Cache::remember('jobs', 60 * 60 * 24, function () {
            return Job::all();
        }));
    }
}
