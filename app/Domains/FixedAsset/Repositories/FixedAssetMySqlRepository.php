<?php

namespace App\Domains\FixedAsset\Repositories;

use App\Domains\FixedAsset\Interfaces\FixedAssetRepositoryInterface;
use App\Domains\FixedAsset\Models\FixedAsset;
use PhpOffice\PhpSpreadsheet\Calculation\Financial\Depreciation;

class FixedAssetMySqlRepository implements FixedAssetRepositoryInterface
{
    public function __construct(private FixedAsset $FixedAsset)
    {
    }

    public function list()
    {
        return $this->FixedAsset::when(request()->search, function ($q) {
            $q->where('name', '%' . request()->search . '%');
        })->orderBy('updated_at', 'desc')->paginate(request('limit', config('app.pagination_count')));
    }


    public function findById(string $id): FixedAsset
    {
        return $this->FixedAsset::findOrFail($id);
    }
    public function store($request)
    {
        $group_id = $account_id = null;
        if ($request->parent_type === 'group') {
            $group_id = $request->parent_id;
            // $parentType = 'Groupmodel;
        }
        if ($request->parent_type === 'account') {
            $account_id = $request->parent_id;
        }
        $asset = $this->FixedAsset::create(
            $request->validated() + [
                'code' => $this->generateCode($request->parent_code, $request->parent_type),
                'parent_account_id' => $account_id,
                'parent_Group_id' => $group_id,
                'creator_id' => auth()->user()->id
            ]
        );

        return $asset;
    }

    public function update(string $id, $request): bool
    {
        $asset = $this->FixedAsset::findOrFail($id);
        $group_id = $account_id = null;
        if ($request->parent_type === 'group') {
            $group_id = $request->parent_id;
        }
        if ($request->parent_type === 'account') {
            $account_id = $request->parent_id;
        }
        $asset->update($request->validated() + [
            'code' => $this->generateCode($request->parent_code, $request->parent_type),
            'parent_account_id' => $account_id,
            'parent_Group_id' => $group_id,
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
}
