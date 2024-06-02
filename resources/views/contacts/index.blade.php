@extends('layouts.master')
@section('title','Liste des contacts')
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
        <h1>Liste des contacts</h1>
        <button
            type="button"
            class="btn btn-primary"
            data-bs-toggle="modal"
            data-bs-target="#ajouterContact"
        >
            Ajouter avec Modal
        </button>
        <a class="btn btn-secondary" href="{{ route('contacts.create') }}"> Ajouter Contact</a>
        <div class="modal fade" id="ajouterContact" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel3">Ajouter un contact</h5>
                        <button
                            type="button"
                            class="btn-close"
                            data-bs-dismiss="modal"
                            aria-label="Close"
                        ></button>
                    </div>
                    <div class="modal-body">
                        <!-- Add Contact Form -->
                        {{-- <form id="addContactForm" action="{{ route('contacts.store') }}" method="POST">
                            @csrf --}}
                            <div class="row g-2">
                                <div class="col mb-0">
                                    <label for="nom" class="form-label">Nom</label>
                                    <input type="text" id="nom" name="nom" class="form-control" placeholder="Entrer le nom" />
                                </div>
                                <div id="errorMessages" class="text-danger"></div>

                                <div class="col mb-0">
                                    <label for="prenom" class="form-label">Prenom</label>
                                    <input type="text" id="prenom" name="prenom" class="form-control" placeholder="Entrer le prenom" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text" id="email" name="email" class="form-control" placeholder="Enter email" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="telephone_fixe" class="form-label">Téléphone Fixe</label>
                                    <input type="text" id="telephone_fixe" name="telephone_fixe" class="form-control" placeholder="Enter téléphone fixe" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="nom_org" class="form-label">Nom Entreprise</label>
                                    <input type="text" id="nom_org" name="nom_org" class="form-control" placeholder="Enter nom entreprise" />
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mb-3">
                                    <label for="adresse" class="form-label">Adresse</label>
                                    <textarea name="adresse" id="adresse" class="form-control" ></textarea>
                                </div>
                            </div>
                            <div class="row g-3">
                                <div class="col xs-0">
                                    <label for="code_postal" class="form-label">Code Postal</label>
                                    <input type="text" id="code_postal" name="code_postal" class="form-control" placeholder="Entrer le code postal" />
                                </div>
                                <div class="col mb-0">
                                    <label for="ville" class="form-label">Ville</label>
                                    <input type="text" id="ville" name="ville" class="form-control" placeholder="Entrer la ville" />
                                </div>
                            </div>
                            <div class="row g-3">
                                <div class="col xs-0">
                                    <label for="service" class="form-label">Service</label>
                                    <input type="text" id="service" name="service" class="form-control" placeholder="Entrer le service" />
                                </div>
                                <div class="col mb-0">
                                    <label for="fonction" class="form-label">Fonction</label>
                                    <input type="text" id="fonction" name="fonction" class="form-control" placeholder="Entrer la fonction" />
                                </div>
                            </div>
                            <div class="row g-3">
                                <div class="col xs-0">
                                    <label for="service" class="form-label">Statut</label>
                                    <select id="statut" name="statut" class="form-select">
                                        <option selected value="">Sélectionnez statut</option>
                                        <option value="Lead">Lead</option>
                                        <option value="Client">Client</option>
                                        <option value="Prospect">Prospect</option>
                                      </select>
                                </div>
                                <div class="col mb-0">

                                </div>
                            </div>
                        {{-- </form> --}}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                            Fermer
                        </button>
                        {{-- <button type="submit" form="addContactForm" class="btn btn-primary">Ajouter</button> --}}
                        <button type="submit" id="nxt1" class="btn btn-primary">Ajouter</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <!-- <div class="table-responsive text-nowrap"> -->
        <table class="table"  id="myTable2">
            <thead>
                <tr class="text-nowrap">
                    <th>Nom Contact</th>
                    <th>Email</th>
                    <th>Telephone Fixe</th>
                    <th>Fonction</th>
                    <th>Organisation</th>
                    <th>Statut</th>
                    <th>Cle</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($contacts as $contact)
                    @if ($contact->active==1)
                        <tr>
                            <td>{{$contact->nom}} {{$contact->prenom}}</td>
                            <td>{{$contact->email}}</td>
                            <td>{{$contact->telephone_fixe}}</td>
                            <td>{{$contact->fonction}}</td>
                            <td>{{$contact->organisation->nom_org}}</td>
                            <td>
                                @if ($contact->organisation->statut == "Lead")
                                    <span class="badge rounded-pill bg-label-primary">{{$contact->organisation->statut}}</span>
                                @elseif ($contact->organisation->statut == "Client")
                                    <span class="badge rounded-pill bg-label-success">{{$contact->organisation->statut}}</span>
                                @elseif($contact->organisation->statut == "Prospect")
                                    <span class="badge rounded-pill bg-label-danger">{{$contact->organisation->statut}}</span>
                                @endif
                            </td>
                            <td>{{$contact->cle}}</td>
                            <td>
                                <div class="button-container">
                                    {{-- <a href="{{ route('contacts.edit',$contact->id) }}" class="btn btn-icon btn-outline-secondary"
                                        data-bs-toggle="tooltip"
                                        data-bs-offset="0,4"
                                        data-bs-placement="right"
                                        data-bs-html="true"
                                        title="<span>Edit Normal</span>">
                                        <i class="tf-icons bx bx-edit-alt"></i>
                                    </a> --}}

                                    <!-- Update Button -->
                                    <button type="button" class="btn rounded-pill btn-icon btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#updateModal{{$contact->id}}">
                                        <i class="tf-icons bx bx-edit-alt"></i>
                                    </button>  &nbsp;
                                    <!-- Update Modal -->
                                    <div class="modal fade" id="updateModal{{$contact->id}}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel3">Modifier un contact</h5>
                                                    <button
                                                        type="button"
                                                        class="btn-close"
                                                        data-bs-dismiss="modal"
                                                        aria-label="Close"
                                                    ></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form id="updateContactForm{{$contact->id}}" action="{{ route('contacts.update', $contact->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <input type="hidden" name="id" value="{{$contact->id}}">
                                                        <div class="row g-2">
                                                            <div class="col mb-0">
                                                                <label for="nom" class="form-label">Nom</label>
                                                                <input type="text" id="nom" name="nom" class="form-control" value="{{$contact->nom}}" />
                                                            </div>
                                                            <div class="col mb-0">
                                                                <label for="prenom" class="form-label">Prenom</label>
                                                                <input type="text" id="prenom" name="prenom" class="form-control" value="{{$contact->prenom}}" />
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col mb-3">
                                                                <label for="email" class="form-label">Email</label>
                                                                <input type="text" id="email" name="email" class="form-control" value="{{$contact->email}}" />
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col mb-3">
                                                                <label for="telephone_fixe" class="form-label">Téléphone Fixe</label>
                                                                <input type="text" id="telephone_fixe" name="telephone_fixe" class="form-control" value="{{$contact->telephone_fixe}}" />
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col mb-3">
                                                                <label for="nom_org" class="form-label">Nom Entreprise</label>
                                                                <input type="text" id="nom_org" name="nom_org" class="form-control" value="{{$contact->organisation->nom_org}}" />
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col mb-3">
                                                                <label for="adresse" class="form-label">Adresse</label>
                                                                <textarea name="adresse" id="adresse" class="form-control" >{{$contact->organisation->adresse}}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="row g-3">
                                                            <div class="col xs-0">
                                                                <label for="code_postal" class="form-label">Code Postal</label>
                                                                <input type="text" id="code_postal" name="code_postal" class="form-control" value="{{$contact->organisation->code_postal}}" />
                                                            </div>
                                                            <div class="col mb-0">
                                                                <label for="ville" class="form-label">Ville</label>
                                                                <input type="text" id="ville" name="ville" class="form-control" value="{{$contact->organisation->ville}}" />
                                                            </div>
                                                        </div>
                                                        <div class="row g-3">
                                                            <div class="col xs-0">
                                                                <label for="service" class="form-label">Service</label>
                                                                <input type="text" id="service" name="service" class="form-control" value="{{$contact->service}}" />
                                                            </div>
                                                            <div class="col mb-0">
                                                                <label for="fonction" class="form-label">Fonction</label>
                                                                <input type="text" id="fonction" name="fonction" class="form-control" value="{{$contact->fonction}}" />
                                                            </div>
                                                        </div>
                                                        <div class="row g-3">
                                                            <div class="col xs-0">
                                                                <label for="service" class="form-label">Statut</label>
                                                                <select id="statut" name="statut" class="form-select">
                                                                    <option value="Lead" @if ($contact->organisation->statut == "Lead")
                                                                        @selected(true)
                                                                    @endif>Lead</option>
                                                                    <option value="Client" @if ($contact->organisation->statut == "Client")
                                                                        @selected(true)
                                                                    @endif>Client</option>
                                                                    <option value="Prospect" @if ($contact->organisation->statut == "Prospect")
                                                                        @selected(true)
                                                                    @endif>Prospect</option>
                                                                  </select>
                                                            </div>
                                                            <div class="col mb-0">
                            
                                                            </div>
                                                        </div>
                                                        <!-- Other fields for updating a contact -->
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                                        Fermer
                                                    </button>
                                                    <button type="submit" form="updateContactForm{{$contact->id}}" class="btn btn-primary">Enregistrer</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="button" class="btn rounded-pill btn-icon btn-outline-success" data-bs-toggle="modal" data-bs-target="#detailContact{{$contact->id}}">
                                        <i class="tf-icons bx bx-detail"></i>
                                    </button> &nbsp;
                                    <!-- Detail Modal -->
                                    <div class="modal fade" id="detailContact{{$contact->id}}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel3">Detail un contact</h5>
                                                    <button
                                                        type="button"
                                                        class="btn-close"
                                                        data-bs-dismiss="modal"
                                                        aria-label="Close"
                                                    ></button>
                                                </div>
                                                <div class="modal-body">
                                                        <input type="hidden" name="id" value="{{$contact->id}}">
                                                        <div class="row g-2">
                                                            <div class="col mb-0">
                                                                <label for="nom" class="form-label">Nom</label>
                                                                <input type="text" id="nom" name="nom" class="form-control" value="{{$contact->nom}}" disabled />
                                                            </div>
                                                            <div class="col mb-0">
                                                                <label for="prenom" class="form-label">Prenom</label>
                                                                <input type="text" id="prenom" name="prenom" class="form-control" value="{{$contact->prenom}}" disabled />
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col mb-3">
                                                                <label for="email" class="form-label">Email</label>
                                                                <input type="text" id="email" name="email" class="form-control" value="{{$contact->email}}" disabled />
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col mb-3">
                                                                <label for="telephone_fixe" class="form-label">Téléphone Fixe</label>
                                                                <input type="text" id="telephone_fixe" name="telephone_fixe" class="form-control" value="{{$contact->telephone_fixe}}" disabled />
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col mb-3">
                                                                <label for="nom_org" class="form-label">Nom Entreprise</label>
                                                                <input type="text" id="nom_org" name="nom_org" class="form-control" value="{{$contact->organisation->nom_org}}" disabled />
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col mb-3">
                                                                <label for="adresse" class="form-label">Adresse</label>
                                                                <textarea name="adresse" id="adresse" class="form-control" disabled>{{$contact->organisation->adresse}}</textarea>
                                                            </div>
                                                        </div>
                                                        <div class="row g-3">
                                                            <div class="col xs-0">
                                                                <label for="code_postal" class="form-label">Code Postal</label>
                                                                <input type="text" id="code_postal" name="code_postal" class="form-control" value="{{$contact->organisation->code_postal}}" disabled />
                                                            </div>
                                                            <div class="col mb-0">
                                                                <label for="ville" class="form-label">Ville</label>
                                                                <input type="text" id="ville" name="ville" class="form-control" value="{{$contact->organisation->ville}}" disabled />
                                                            </div>
                                                        </div>
                                                        <div class="row g-3">
                                                            <div class="col xs-0">
                                                                <label for="service" class="form-label">Service</label>
                                                                <input type="text" id="service" name="service" class="form-control"  value="{{$contact->service}}" disabled />
                                                            </div>
                                                            <div class="col mb-0">
                                                                <label for="fonction" class="form-label">Fonction</label>
                                                                <input type="text" id="fonction" name="fonction" class="form-control"  value="{{$contact->fonction}}" disabled />
                                                            </div>
                                                        </div>
                                                        <div class="row g-3">
                                                            <div class="col xs-0">
                                                                <label for="service" class="form-label">Statut</label>
                                                                <select id="statut" name="statut" class="form-select" disabled>
                                                                    <option selected value="">{{$contact->organisation->statut}}</option>
                                                                    
                                                                  </select>
                                                            </div>
                                                            <div class="col mb-0">
                            
                                                            </div>
                                                        </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                                                        Fermer
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Delete Form -->
                                    <form id="deleteForm{{$contact->id}}" action="{{ route('contacts.destroy', $contact->id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="button" onclick="confirmDelete('{{$contact->id}}')" class="btn rounded-pill btn-icon btn-outline-danger">
                                            <span class="tf-icons bx bx-trash-alt"></span>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @endif
                    
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
<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>


<script>
    // let contacts =[];
    // let organisations =[];

   
    $(document).ready(function () {
        let contactExist=false;

        // let table = new DataTable('#myTable');
        let table = new DataTable('#myTable2');
        let organisations =[];
        let nom ='';
        let prenom ='';
        let email ='';
        let telephone_fixe ='';
        let service ='';
        let fonction ='';
        let statut ='';
        let code_postal ='';
        let ville='';
        let nom_org='';
        // $.ajaxSetup({
        //     headers: {
        //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     }
        // });
        // $.ajax({
        //     url: '/getAllContacts', // L'URL de la route que vous avez définie dans Laravel
        //     type: 'GET',
        //     dataType: 'json',
        //     success: function(response) {  
        //         var dataArray = response;
        //         dataArray.forEach(function(item) {
        //             contacts.push(item);
        //         });
        //     },
        //     error: function(xhr, status, error) {
        //             console.error(error); // En cas d'erreur, affiche l'erreur dans la console
        //     }
        // });
        // $.ajax({
        //     url: '/getAllOrganisations', // L'URL de la route que vous avez définie dans Laravel
        //     type: 'GET',
        //     dataType: 'json',
        //     success: function(response) {  
        //         var dataArray = response;
        //         dataArray.forEach(function(item) {
        //             organisations.push(item);
        //             console.log(organisations);
        //         });
        //     },
        //     error: function(xhr, status, error) {
        //             console.error(error); // En cas d'erreur, affiche l'erreur dans la console
        //     }
        // });
        
    });
    function showError(message) {
        $('#errorMessages').html(message);
    }
   
    
    function validation() {
        console.log("hhhhhhhh");
        
    }
    
    function confirmDelete(contactId) {
        Swal.fire({
            title: "Êtes-vous sûr(e)?",
            text: "Voulez-vous vraiment supprimer?",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: '#FF0000', // Définit la couleur du bouton directement
            confirmButtonText: "Supprimer",
            cancelButtonText: "Annuler",
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Utilisation de l'ID du contact pour obtenir le bon formulaire
                document.getElementById('deleteForm' + contactId).submit();
            }
        });
    }

</script>



@endsection