@if (count($category['childrens']) > 0)
    <li class="dropdown">
        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="true">{{ $category['name'] }}<span class="caret"></span></a>
        <ul class="dropdown-menu dropdownhover-bottom" role="menu">

            @foreach($category['childrens'] as $category)
                @include('admin.category.dropdown', $category)
            @endforeach

        </ul>
    </li>
@else
    <li><a>{{ $category['name'] }}</a></li>
@endif




