@extends('layouts.master')
@section('title','Liste des organisations')
@section('content')
<style>
    .button-container {
        display: flex;
    }
    .button-container form,
    .button-container a {
        margin-right: 10px; /* Adjust the margin as needed */
    }
</style>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<div class="container">
    <div>
        <h1>Liste des organisations</h1>
        
    </div>
    <br>
    <!-- <div class="table-responsive text-nowrap"> -->
        <table class="table"  id="myTable">
            <thead>
                <tr class="text-nowrap">
                    <th>Nom</th>
                    <th>Adresse</th>
                    <th>Code Postal</th>
                    <th>Ville</th>
                    <th>Statut</th>
                    <th>Cle</th>

                </tr>
            </thead>
            <tbody>
                @foreach($organisations as $organistion)
                    <tr>
                        <td>{{$organistion->nom_org}}</td>
                        <td>{{$organistion->adresse}}</td>
                        <td>{{$organistion->code_postal}}</td>

                        <td>{{$organistion->ville}}</td>
                        <td>{{$organistion->statut}}</td>
                        <td>{{$organistion->cle}}</td>                        
                    </tr>
                @endforeach
            </tbody>

        </table>
    <!-- </div> -->
   


</div>
<script
  src="https://code.jquery.com/jquery-3.7.1.slim.js"
  integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc="
  crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>

<script>
    $(document).ready(function () {
        // let table = new DataTable('#myTable');
        let table = new DataTable('#myTable');
    });
       
    
    function confirmDelete() {
		Swal.fire({
			title: "Etes vous sure?",
			text: "de vouloir supprimer",
			icon: "warning",
			showCancelButton: true,
            confirmButtonColor: '#FF0000', // Définit la couleur du bouton directement
			confirmButtonText: "Supprimer",
			cancelButtonText: "Annuler",
			reverseButtons: true
		}).then((result) => {
			if (result.isConfirmed) {
				document.getElementById('deleteForm').submit();
			}
		});
	}
</script>



@endsection