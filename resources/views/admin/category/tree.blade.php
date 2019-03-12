@if(count($category['childrens']) > 0 )

    <li>{{ $category['name'] }}
        <ul>
            @foreach($category['childrens'] as $category)
                @include('admin.category.tree', $category)
            @endforeach
        </ul>
    </li>

@else
    <li data-jstree='"type":"html"}'>{{ $category['name'] }}</li>
@endif

