<?php

namespace App\Domains\FixedAsset\Repositories;

use App\Domains\Account\Models\Account;
use App\Domains\FixedAsset\Interfaces\FixedAssetRepositoryInterface;
use App\Domains\FixedAsset\Models\FixedAsset;
use App\Domains\Group\Models\Group;
use Illuminate\Support\Collection;
use PhpOffice\PhpSpreadsheet\Calculation\Financial\Depreciation;

class FixedAssetMySqlRepository implements FixedAssetRepositoryInterface
{
    public function __construct(private FixedAsset $FixedAsset)
    {
    }

    public function list()
    {
        $fixedAssets = $this->FixedAsset::when(request()->search, function ($q) {
            $q->where('name', 'like', '%' . request()->search . '%');
            $q->orWhere('description', 'like', '%' . request()->search . '%');
        })->when(request()->depreciation_ratio, function ($q) {
            $q->where('depreciation_ratio', request()->depreciation_ratio);
        })->when(request()->depreciation_value, function ($q) {
            $q->where('depreciation_value', request()->depreciation_value);
        })->when(request()->acquisition_value, function ($q) {
            $q->where('acquisition_value', request()->acquisition_value);
        })->when(request()->acquisition_date, function ($q) {
            $q->whereDate('acquisition_date', '>=', request()->acquisition_date);
        })->when(request()->creator_id, function ($q) {
            $q->where('creator_id', request()->creator_id);
        })->when(request()->from || request()->to, function ($q) {
            $q->whereBetween('created_at', [request()->from, request()->to]);
        })->when(request()->sort_by, function ($q) {
            if (in_array(request()->sort_by, ['code', 'name', 'acquisition_value', 'acquisition_date', 'depreciation_value', 'created_at', 'id', 'creator_id'])) {
                $q->orderBy(request()->sort_by, request()->sort_type === 'asc' ? 'asc' : 'desc');
            }
        })->orderBy('updated_at', 'desc')->with(['creator', 'parent:id,name,code'])->paginate(request('limit', config('app.pagination_count')))
            ->map(function ($fixedAsset) {
                $fixedAsset->depreciation = $this->getDepreciation($fixedAsset);
                return $fixedAsset;
            });
        return $fixedAssets;
    }


    public function findById(string $id): FixedAsset
    {
        return $this->FixedAsset::findOrFail($id);
    }
    public function store($request)
    {
        if ($request->parent_type === 'group') {
            $parent = Group::find($request->parent_id);
        }
        if ($request->parent_type === 'account') {
            $parent = Account::find($request->parent_id);
        }
        $asset = $this->FixedAsset::create(
            $request->validated() + [
                'code' => $this->generateCode($request->parent_code, $request->parent_type),
                'creator_id' => auth()->user()->id
            ]
        );
        $parent->fixedAssets()->save($asset);
        return $asset;
    }

    public function update(string $id, $request): bool
    {
        $asset = $this->FixedAsset::findOrFail($id);

        if ($request->parent_type === 'group') {
            $newParent = Group::find($request->parent_id);
        } elseif ($request->parent_type === 'account') {
            $newParent = Account::find($request->parent_id);
        }

        $asset->parent()->associate($newParent);
        $asset->update(request()->except('parent_code', 'parent_id') + [
            'code' => $this->generateCode($request->parent_code, $request->parent_type),
        ]);
        return true;
    }

    public function delete(string $id): bool
    {
        $this->FixedAsset::findOrFail($id)?->delete();
        return true;
    }

    /**
     * Generate new fixed asset code based on parent code and parent type
     * @param int $parentCode
     * @param string $parentType
     */
    private function generateCode(int $parentCode, string $parentType)
    {
        $code = '';
        $codeLength = 12;
        if ($parentType === 'group') {
            $codeLength = 8;
        }
        $lastAsset = FixedAsset::where('code', 'like', $parentCode . '%')->orderBy('id', 'desc')->first();
        if ($lastAsset) {
            $lastAssetCode = $lastAsset->code + 1;
        } else {
            $lastAssetCode = (int) ($parentCode . '0001');
        }
        $code = str_pad($lastAssetCode, $codeLength, '0', STR_PAD_LEFT);

        return $code;
    }

    /**
     * Calculate Depreciation value .
     * @param \App\Domains\FixedAsset\Models\FixedAsset $fixedAsset
     * @return float
     */
    private function getDepreciation(FixedAsset $fixedAsset): float
    {
        $depreciationDuration = $fixedAsset->depreciation_duration_value;
        $acquisitionValue = $fixedAsset->acquisition_value;
        $depreciationValue = $fixedAsset->depreciation_value;

        if ($depreciationDuration === 0) {
            return 0.0;
        }
        return ($acquisitionValue - $depreciationValue) / $depreciationDuration;
    }
    private function getDepreciation_(FixedAsset $fixedAsset): float
    {
        $depreciationDuration = $fixedAsset->depreciation_duration_value;
        $depreciationDuration_type = $fixedAsset->depreciation_duration_type;
        $acquisitionValue = $fixedAsset->acquisition_value;
        $depreciationValue = $fixedAsset->depreciation_value;

        if ($depreciationDuration === 0) {
            return 0.0;
        }
        switch ($depreciationDuration_type) {
            case 'day':
                return ($acquisitionValue - $depreciationValue) / ($depreciationDuration);
            case 'month':
                # code...
                break;
            case 'year':
                # code...
                break;
            default:
                # code as a year...
                break;
        }
        return ($acquisitionValue - $depreciationValue) / $depreciationDuration;
    }
}
