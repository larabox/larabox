@extends('layouts.email')

@section('body')

        <!-- content -->
        <div class="content">
            <table>
                <tr>
                    <td>
                        <h1>{{$title}}</h1>

                        <h4>Контактные данные</h4>

                        <p>ФИО: <strong>{{$name}}</strong></p>
                        <p>Телефон: <strong>{{$telefon}}</strong></p>
                        <p>Тип доставки: <strong>{{$dostavka}}</strong></p>
                        <p>Адрес: <strong>{{$adress}}</strong></p>

                        <hr>
                        <p>Ощая стоимость: <strong>{{$cost}}</strong></p>
                        <p>Ощие количество: <strong>{{$size}}</strong></p>
                        <hr>

                        <p class="lead">{{$description}}</p>
                    </td>
                </tr>
            </table>
        </div><!-- /content -->

        @include('chunk.cart.list_email')
@stop