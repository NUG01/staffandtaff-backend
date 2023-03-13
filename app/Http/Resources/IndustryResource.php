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
            'industry_name' => $this->name,
            'industry_slug' => $this->slug,
            'positions' => PositionResource::collection(Position::whereIn('id', (array)$this->children_id)->get()),
        ];
    }

    public static function updateIndustryOrPosition($category, $request)
    {
        $category->update([
            'name' => $request->name,
            'slug' => str_slug($request->name, '_'),
        ]);
    }

    public static function updateChildrenIds($category, $subcategory)
    {
        $category->update([
            'children_id' => array_merge($category->children_id, (array)$subcategory->id)
        ]);
    }

    public static function destroy($category)
    {
        $children_ids = Industry::whereNot('id', $category->id)->pluck('children_id')->toArray();
        $children_ids = collect($children_ids)->flatten(1)->toArray();

        $result = array_diff($category->children_id, $children_ids);

        $result = array_values($result);

        DB::table('positions')->whereIn('id', $result)->delete();
        $category->delete();
    }
}
