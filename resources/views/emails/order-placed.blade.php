@extends('emails.app')
@section('content')

<table class="inner-body" align="center" width="570" cellpadding="0" cellspacing="0" role="presentation" style="box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; position: relative; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 570px; background-color: #ffffff; border-color: #e8e5ef; border-radius: 2px; border-width: 1px; box-shadow: 0 2px 0 rgba(0, 0, 150, 0.025), 2px 4px 0 rgba(0, 0, 150, 0.015); margin: 0 auto; padding: 0; width: 570px;">
    <!-- Body content -->
    <tbody>
        <tr>
            <td class="content-cell" style="box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; position: relative; max-width: 100vw; padding: 32px;">
                <p style="box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; position: relative; font-size: 16px; line-height: 1.5em; margin-top: 0; text-align: center;">
                        تم تقديم طلبك   <a href="{{ route('customer.order.show',['id' => $order->id]) }}">( #{{ $order->order_number }} )</a>بنجاح.
                    </p>
                <table class="action" align="center" width="100%" cellpadding="0" cellspacing="0" role="presentation" style="box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; position: relative; -premailer-cellpadding: 0; -premailer-cellspacing: 0; -premailer-width: 100%; margin: 30px auto; padding: 0; text-align: center; width: 100%;">
                    <tbody>
                        <tr>
                            <td align="center" style="box-sizing: border-box; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif, 'Apple Color Emoji', 'Segoe UI Emoji', 'Segoe UI Symbol'; position: relative;">
                                <div class="col-xs-12 col-sm-4">
                                    <div class="cart-form-text pay-details order-pay">
                                        <table>
                                                <tr>
                                                    <td>{{ $order->order_date }}</td>
                                                    <th> 
                                                        تاريخ الطلب
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <td>{{ $order->order_number }}</td>
                                                    <th> 
                                                        رقم الأمر
                                                    </th>
                                                </tr>                                                
                                                <tr>
                                                    <td> {{ \App\Helpers\UtilityHelper::getCurrency() }} {{ $order->subtotal }}</td>
                                                    <th>المجموع </th>
                                                    
                                                </tr>
                                                <tr>
                                                    <td>{{ \App\Helpers\UtilityHelper::getCurrency() }} {{ $order->discount }}</td>
                                                    <th>الخصم </th>
                                                </tr>
                                                <tr>
                                                    <td>{{ \App\Helpers\UtilityHelper::getCurrency() }} {{ $order->total }}</td>
                                                    <th>المجموع الكلي</th>
                                                </tr>
                                            
                                        </table>
                                    </div>
                                </div>
                                <div class="col-xs-12 col-sm-8">

                                    @foreach($order->order_items as $item)

                                        @php

                                            $item->item = null;

                                            if($item->type == 'course'){
                                                $item->item = \App\Models\Course::find($item->item_id);
                                            }else{
                                                $item->item = \App\Models\Note::find($item->item_id);
                                            }
                                            
                                            $route = null;

                                            $data = [
                                                'education_level' => $item->item->subject->education_level , 
                                                'university_id' => $item->item->university_id > 0 ? $item->item->university_id : 0 , 
                                                'subject_id' => $item->item->subject_id , 
                                                'id' => $item->item->id  
                                            ];

                                            if($item->type == 'course'){
                                                $route = route('course.subject.course',$data);
                                            }else{
                                                $route = route('notes.subject.note',$data);
                                            }

                                        @endphp

                                    <div class="single-list-view order-det desktop-order" >
                                        <div class="row">
                                            <div class="col-xs-12 col-md-3">
                                                <div class="list-btn">
                                                        <a href="{{ $route }}" class="btn-line-blue" target="_blank">
                                                            عرض
                                                        </a>
                                                    </div>
                                            </div>
                                            <div class="col-xs-12 col-md-6">
                                                <div class="list-text">
                                                    <h3>
                                                        {{ $item->item->title }}
                                                    </h3>
                                                    <span>
                                                        {{ $item->item->subject->title }}
                                                    </span>
                                                    <p>
                                                        {{ $item->item->short_description }}
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-md-3">
                                                <div class="list-img">
                                                    <div class="product-img">
                                                        
                                                        <a href="{{ $route }}">
                                                            <img src="{{ \App\Helpers\UtilityHelper::renderImage($item->item->image) }}" style="width:159px;height:206px;object-fit:cover" alt="{{ $item->item->title }}" />
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="single-list-view order-det mobile-order" style="display: none;">
                                        <div class="row">
                                            <div class="col-sm-3">
                                                <div class="list-img">
                                                    <div class="product-img">
                                                        
                                                        <a href="{{ $route }}">
                                                            <img src="{{ \App\Helpers\UtilityHelper::renderImage($item->item->image) }}" style="width:270px;height:350px;object-fit:cover" alt="{{ $item->item->title }}" />
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="list-text">
                                                    <h3>
                                                        {{ $item->item->title }}
                                                    </h3>
                                                    <span>
                                                        {{ $item->item->subject->title }}
                                                    </span>
                                                    <p>
                                                        {{ $item->item->short_description }}
                                                    </p>
                                                </div>
                                            </div>
                                            
                                            <div class="col-sm-3">
                                                <div class="list-btn">
                                                        <a href="{{ $route }}" class="btn-line-blue" data-toggle="modal" data-target="#quick-view">عرض</a>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>                                
                                
                            </td>
                        </tr>
                    </tbody>
                </table>
            </td>
        </tr>
    </tbody>
</table>


@endsection
