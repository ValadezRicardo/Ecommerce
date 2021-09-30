@extends('layouts.user')
@section('user')
<script type="text/javascript" src="https://cdn.conekta.io/js/latest/conekta.js"></script>
<?php
      
      $error=session("error");
      Session::put('error',  "");
      ?>
<!-- Modal -->
<div class="modal fade" id="payModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="false" data-backdrop="static"  data-keyboard="false" >
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">Realizar Pago</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      <form action="" method="POST" id="card-form">
  <span class="card-errors"></span>
  <div class="row">
  <div class="col-md-12">
   
      <span>Nombre del tarjetahabiente</span>
      <input type="text" id="nombre" size="20" class="form-control" data-conekta="card[name]">
  </div>
  </div>
  <div class="row">
  <div class="col-md-8">
    
      <span>Número de tarjeta de crédito</span>
      <input type="text" size="20"  class="form-control"  data-conekta="card[number]">
  </div>
  <div class="col-md-4">
      <span>CVC</span>
      <input type="text" size="4"  class="form-control"  data-conekta="card[cvc]">
  </div>
  </div>

  <div class="row">
  <div class="col-md-4">
        <span>Mes de expiración(MM)</span>
      <input type="text" size="2"  class="form-control"  data-conekta="card[exp_month]">
   </div>
   <span style=" font-size: 25px;">/</span>
    <!-- <span>/</span> -->
    <div class="col-md-6">
    <span>Año de expiración(YY)</span>
    <input type="text" size="2"  class="form-control"  data-conekta="card[exp_year]">
    <input type="hidden" name="conektaTokenId" id="conektaTokenId">
    </div>
  </div>
  <button type="submit" class="hide" id="btnsubmit">Crear token</button>
</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary" onclick="$('#btnsubmit').click()">Pagar</button>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>
<main class="page-content">
    <!-- Breadcrumbs & Page title-->
    <section class="text-center section-34 section-sm-60 section-md-top-100 section-md-bottom-105 bg-image bg-image-breadcrumbs">
        <div class="container">
            <div class="row no-gutters">
                <div class="col-xs-12 col-xl-preffix-1 col-xl-11">
                    <p class="h3 text-white">Mi carrito de compras</p>
                    <ul class="breadcrumbs-custom offset-top-10">
                        <li><a href="{{route('inicio')}}">Inicio</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <section class="section-50 section-sm-100">
        <div class="container">
            <div class="row">
                <div class="col-xs-12">
                    <h4 class="text-left font-default">{{count($carrito)}} items en el carrito</h4>
                    <div class="table-responsive offset-top-10">
                        <table class="table table-shopping-cart">
                            <tbody>
                                @if (count($carrito) <= '0' ) <tr>
                                    <td>No hay nigun producto en el carrito.</td>
                                    </tr>
                                    @else
                                    @foreach ($carrito as $item)
                                    <tr>

                                        <td style="width: 1px">
                                            <div class="inset-left-20">
                                                <div class="product-image"><img src="{{asset('admin/'.$item->portada)}}" width="130" height="130" alt=""></div>
                                            </div>
                                        </td>
                                        <td style="min-width: 340px;">
                                            <div class="inset-left-30 text-left"><span class="product-brand text-italic">{{substr($item->createAt,0,10)}}</span>
                                                <div class="h5 text-sbold offset-top-0"><a class="link-default" href="shop-single.html">{{$item->alimento}}</a></div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="inset-left-20"><span class="h5 text-sbold">${{$item->precio}}</span></div>
                                        </td>
                                        <td>
                                            <div class="inset-left-20">


                                                <form action="{{route('destroy_carrito',$item->id)}}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="icon icon-sm mdi mdi-window-close link-gray-lightest" type="submit"></button>
                                                </form>


                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    @endif


                            </tbody>
                        </table>
                    </div>
                    @if (count($carrito) > '0')
                    <div class="row">
                        <div class="col-lg-6 offset-top-35 text-left" id="direccion">
                            <label><b>Dirección De Envio</b></label>
                            <input type="text" id="direccion" name="direccion" class="form-control col-lg-8 fieldVal" placeholder="Dirección">
                        </div>
                        <div class="col-lg-6 offset-top-35 text-left" id="telefono">
                            <label><b>Teléfono</b></label>
                            <input type="text" id="telefono" name="telefono" class="form-control col-lg-8 fieldVal" placeholder="Telefono">
                        </div>
                        <div class="col-lg-6 offset-top-35 text-left" id="correo">
                            <label><b>Correo Electronico</b></label>
                            <input type="text" id="correo" name="correo" class="form-control col-lg-8 fieldVal" placeholder="Correo">
                        </div>
                        <div class="col-lg-6 offset-top-35 text-left" >
                            <label><b>De</b></label>
                            <input type="text" id="de" name="correo" class="form-control col-lg-8 fieldVal" placeholder="De">
                        </div>
                        <div class="col-lg-6 offset-top-35 text-left">
                            <label><b>Para</b></label>
                            <input type="text" id="para" name="correo" class="form-control col-lg-8 fieldVal" placeholder="Para">
                        </div>
                        <div class="col-lg-6 offset-top-35 text-left">
                            <label><b>Fecha</b></label>
                            <input type="date" id="fecha" name="fecha" class="form-control col-lg-8 fieldVal" placeholder="Para">
                        </div>
                        <div class="col-lg-6 offset-top-35 text-left" >
                            <label><b>Horario</b></label>
			    <div class="col-lg-8" style="padding:0;">
			    <select id="horario" name="horario" lass="form-control fieldVal" placeholder="Horario">
				<option value="M">Mañana (9 a 12)</option>
				<option value="T">Tarde (1 a 6)</option>
				<option value="N">Noche (7 a 10)</option>
			    <select>
                        </div>
                        </div>
                        <div class="col-lg-6 offset-top-35 text-left">
                            <label><b>Mensaje</b></label>
			    <textarea name="mensaje" class="form-control col-lg-8 fieldVal" placeholder="Mensaje"  id="mensaje"> </textarea>
                        </div>
                        <div class="col-lg-6 offset-top-35 text-left">
                            <label><b>Cupon</b></label>
			     <input type="text" id="codigoCupon" name="codigoCupon" class="form-control col-lg-8 fieldVal" placeholder="Codigo Cupon">
                        </div>
                        <div class="col-lg-6 offset-top-35 text-left"> </div>
                        <div class="col-lg-6 offset-top-35 text-right">
                            <div class="h4 font-default text-bold">
                                <small class="inset-right-5 text-gray-light">Total: </small> 
                               $ <span id="total">{{$total->total}}<span>
                            </div>
                            <script>var totaloriginal={{$total->total}}</script>
                            <div class="h4 font-default text-bold" id="divdescuento" style="display: none;">
                                <small class="inset-right-5 text-gray-light">Descuento: </small> 
                               $ <span id="descuento">0<span>
                            </div>
                            <button disabled class="btn btn-icon btn-icon-left btn-burnt-sienna btn-shape-circle offset-top-35" id="buyButton">
                                <span class="thin-icon-card" style="font-size: 25px;"></span>
                                <span>Procesar con tarjeta</span>
                            </button>
                        </div>

                    </div>
                    @endif
                </div>
            </div>
        </div>
    </section>

    
</main>
@push('scripts')
<script>
    var error="";
    error= '<?php echo $error ?>';

    if(error){
     alert(error);
    }

    var publicKey = '<?php echo $config->culqi_public ?>';
    $("#card-form").submit(function(e){
        e.preventDefault();
        // Conekta.setPublicKey('key_F5NuxJ5FiV5jqrUEazgkRwQ');
        Conekta.setPublicKey(publicKey);
        var $form = $("#card-form");
        var conektaSuccessResponseHandler = function(token) {
            var $form = $("#card-form");
            //Inserta el token_id en la forma para que se envíe al servidor
            $form.find(".card-errors").text("");
            $('#conektaTokenId').val(token.id);
            ProcessPay(token.id,null);
            // $form.get(0).submit(); //Hace submit
            };

            var conektaErrorResponseHandler = function(response) {
            var $form = $("#card-form");
            $form.find(".card-errors").text(response.message_to_purchaser);
            $form.find("button").prop("disabled", false);
                ProcessPay(null,response.message_to_purchaser);
            };

            Conekta.Token.create($form, conektaSuccessResponseHandler, conektaErrorResponseHandler);
            
        return false;

    });
    


    $(document).ready(function() {
        $('#direccion div').removeClass("stepper");
        $('.stepper-arrow').css("display", "none");
    });

    // $('#direccion').keyup(function() {
        
    //     var car_direccion = $('#direccion').val();
    //     if (car_direccion >= '2') {
    //         $('#buyButton').attr("disabled", false);
    //     } else {
    //         $('#buyButton').attr("disabled", true);
    //     }
    // });
    $('.fieldVal').blur(function(){
        var car_direccion = $('#direccion input').val();
        var car_telefono = $('#telefono input').val();
        var car_correo = $('#correo input').val();
        if(car_direccion&&car_telefono&&car_correo){
            $('#buyButton').attr("disabled", false);
        }
        else{
            $('#buyButton').attr("disabled", true);
        }

    });

    


    Culqi.settings({
        title: '<?php echo $config->nombre_empresa ?>',
        currency: 'USD',
        amount: Math.round('<?php echo $total->total ?>') + '00',
    });
    $('#buyButton').on('click', function(e) {
        // Abre el formulario con las opciones de Culqi.settings
        $('#payModal').modal({
    backdrop: 'static',
    keyboard: false
}
        );
    });

   
    // Usa la funcion Culqi.open() en el evento que desees
    $('#buyButton2').on('click', function(e) {
        // Abre el formulario con las opciones de Culqi.settings
        Culqi.open();
        e.preventDefault();
    });

    function ProcessPay(token,error) {
        if (token) {
            // let token = token;
            let productos = '<?php echo $data_productos ?>';
            let transanccion = token;
            let iduser = "<?php echo auth()->user()->id ?>";
            let precio = '<?php echo round($total->total) ?>';
            let telefono=$('#telefono input').val();
            let correo=$('#correo input').val();
            let direccion = $('#direccion input').val();
            let nombre = $('#nombre').val();

            let de= $('#de').val();
            let para = $('#para').val();
            let horario = $('#horario').val();
            let mensaje= $('#mensaje').val();
            let codigoCupon=$('#codigoCupon').val();
            let fecha=$('#fecha').val();
            return window.location = "../../../../../../cuenta/pedido/" + nombre + "/" +  productos+  "/" + iduser + "/" + direccion +"/" + telefono +"/" + correo + "/" +de +"/" +para +"/" + horario+"/"+fecha+"/" + mensaje +"/" +   precio + "/" + token+ "/" + codigoCupon + '/conekta';
        } else if(error) {
            console.log(error);
            alert(error);
        }
    };

    $('#codigoCupon').change(function(){
        if($('#codigoCupon').val()=='')
        {
            $('#total').text(formatMoney(totaloriginal));
            $('#divdescuento').hide();
        }
        else{
            $.ajax({
        url: '../panel/configuraciones/validateCode/'+$('#codigoCupon').val(),
        success: function(respuesta) {
            if(respuesta==-1){
                alert("Codigo Invalido");
                 $('#total').text(formatMoney(totaloriginal));
                 $('#codigoCupon').val('');
                 $('#divdescuento').hide();
            }
            else{
                let tot=parseInt(totaloriginal);
                descuento=tot*(respuesta/100); 
                $('#total').text(formatMoney(tot-descuento));
                $('#divdescuento').show();
                $('#descuento').text(formatMoney(descuento));
            }
        },
        error: function() {
            $('#total').text(formatMoney(totaloriginal));
            alert("Codigo Invalido");
           $('#codigoCupon').val('');
           $('#divdescuento').hide();
        }
    });
        }
      
    });

    function formatMoney(number, decPlaces, decSep, thouSep) {
    decPlaces = isNaN(decPlaces = Math.abs(decPlaces)) ? 2 : decPlaces,
    decSep = typeof decSep === "undefined" ? "." : decSep;
    thouSep = typeof thouSep === "undefined" ? "," : thouSep;
    var sign = number < 0 ? "-" : "";
    var i = String(parseInt(number = Math.abs(Number(number) || 0).toFixed(decPlaces)));
    var j = (j = i.length) > 3 ? j % 3 : 0;

    return sign +
        (j ? i.substr(0, j) + thouSep : "") +
        i.substr(j).replace(/(\decSep{3})(?=\decSep)/g, "$1" + thouSep) +
	(decPlaces ? decSep + Math.abs(number - i).toFixed(decPlaces).slice(2) : "");
}

</script>
@endpush
@endsection
<style>
.select2-selection.select2-selection--single:not(:focus) {
    border-color: gray!important;
}
</style>