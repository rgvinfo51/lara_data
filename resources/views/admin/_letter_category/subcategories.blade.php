 
 @if (count($cat->children) > 0)
	  @php
		 $count = $count.'-';
		 @endphp
	  @foreach ($cat->children as $sub)
	
			<option {{(old('parent_id',$sub->id) == $category->parent_id) ? 'selected': ''}} value="{{$sub->id}}">{{ $count }} {{$sub->name}}</option>
			@include('admin.letter_category.subcategories', ['cat' => $sub,'count'=> $count])        
		 
        @endforeach
@endif