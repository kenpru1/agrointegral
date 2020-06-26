@extends('backend.layouts.app_nobread')

@section('content')
<div class="ibox float-e-margins">
    <div class="ibox-title">
        <h5>Resultado de su Transacción
        <small class="text-muted">Pagos</small>
        </h5>
                            
    </div>
    
 <div class="ibox-content">  
    <div class="table-responsive">

    <table class="table table-striped table-bordered table-hover dataTables">
    	<tr>
    		<td><strong>Nro Orden</strong></td>
    		<td>{{ $response['commerceOrder'] }}</td>
    	</tr>
    	<tr>
    		<td><strong>Nro. Orden Electronica</strong></td>
    		<td>{{ $response['flowOrder'] }}</td>
    	</tr>
    	<tr>
    		<td><strong>Concepto</strong></td>
    		<td>{{ $response['subject'] }}</td>
    	</tr>
    	<tr>
    		<td><strong>Medio</strong></td>
    		<td>{{ $response['paymentData']['media'] }}</td>
    	</tr>
    	<tr>
    		<td><strong>Fecha Pago</strong></td>
    		<td>{{ $response['paymentData']['transferDate'] }}</td>
    	</tr>
        <tr>
            <td><strong>Monto</strong></td>
            <td>{{ $response['paymentData']['amount'] }}</td>
        </tr>
        <tr>
            <td><strong>Pagado Por</strong></td>
            <td>{{ $response['payer'] }}</td>
        </tr>
    	<tr>
    		<td><strong>Estado</strong></td>
    		<td>
                @if($response['status']==1)
                     Pendiente
                @endif
                @if($response['status']==2)
                    Pagada
                @endif
                @if($response['status']==3)
                    Rechazada
                @endif
                @if($response['status']==4)
                    Anulada
                @endif
    		</td>
    	</tr>
    </table>
</div>
</div></div>
@endsection