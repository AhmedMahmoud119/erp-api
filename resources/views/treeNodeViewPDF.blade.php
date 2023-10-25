<tr>
    <td> <pre>{{str_repeat('  ',$counter)}} {{ $treeNode->code }}</pre></td>
    <td> <pre>{{str_repeat('  ',$counter)}} {{ $treeNode->name }}</pre></td>
</tr>

@foreach($treeNode->children as $treeNodeSec)
    @php($counter++)
    @include('treeNodeViewPDF', [
            'treeNode' => $treeNodeSec,
            'counter' => $counter
        ])
@endforeach
