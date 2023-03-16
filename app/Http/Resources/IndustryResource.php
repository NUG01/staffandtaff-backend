<?php

namespace App\Http\Resources;

use App\Models\Industry;
use App\Models\Position;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class IndustryResource extends JsonResource
{
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'slug' => $this->slug,
        ];
    }

    public static function updateIndustryOrPosition($industry, $request)
    {
        $industry->update([
            'name' => $request->name,
            'slug' => str_slug($request->name, '_'),
        ]);
    }

    public static function updateChildrenIds($industry, $position)
    {
        $industry->update([
            'children_id' => array_merge($industry->children_id, (array)$position->id)
        ]);
    }

    public static function destroy($industry)
    {
        $children_ids = Industry::whereNot('id', $industry->id)->pluck('children_id')->toArray();
        $children_ids = collect($children_ids)->flatten(1)->toArray();

        $result = array_diff($industry->children_id, $children_ids);

        $result = array_values($result);

        DB::table('positions')->whereIn('id', $result)->delete();
        $industry->delete();
    }
}
