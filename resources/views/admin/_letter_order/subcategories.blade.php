 
 @if (count($cat->children) > 0)
	  @php
		 $count = $count.'-';
		 @endphp
	  @foreach ($cat->children as $sub)
	
			<option {{(old('category_id',$sub->id) ==  (($order->cat_id) ?? '') ) ? 'selected': ''}}  value="{{$sub->id}}">{{ $count }} {{$sub->name}}</option>
			@include('admin.letter_order.subcategories', ['cat' => $sub,'count'=> $count])        
		 
        @endforeach
@endif