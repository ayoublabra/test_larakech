@extends('layouts.master')
@section('title', 'Ajouter un contact')
@section('content')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

    <!-- Basic with Icons -->
    <div class="col-xxl">
        <div class="card mb-4">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h2 class="mb-0">Ajouter un nouveau contact</h2>
                <a style="margin-top:-25px;" class="btn btn-danger" href="{{ route('contacts.index') }}"> Précédent</a>

                {{-- <small class="text-muted float-end">Merged input group</small> --}}
            </div>
            <div class="card-body">
                 <form id="addContactForm" action="{{ route('contacts.store') }}" method="POST">
                            @csrf
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
                                    <input type="text" id="code_postal" name="code_postal" class="form-control" placeholder="Entrer le code postal" maxlength="5"/>
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
                        </form>
                    <br>
                    <button id="add" style="margin-left: 92%" class="btn btn-primary">Ajouter</button>

            </div>

        </div>
    </div>
    </div>
    <script
  src="https://code.jquery.com/jquery-3.7.1.slim.js"
  integrity="sha256-UgvvN8vBkgO0luPSUl2s8TIlOSYRoGFAX4jlCIm9Adc="
  crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>

    <script>
        $(document).ready(function () {
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


        });
    $("#add").click(function(){
        nom=$("#nom").val();
        prenom=$("#prenom").val();
        email=$("#email").val();
        telephone_fixe=$("#telephone_fixe").val();
        service=$("#service").val();
        fonction=$("#fonction").val();
        nom_org=$("#nom_org").val();
        statut=$("#statut").val();
        ville=$("#ville").val();
        code_postal=$("#code_postal").val();
        if (!nom || !prenom || !email || !telephone_fixe || !service || !fonction || !nom_org || !code_postal) {
            Swal.fire({
                icon: 'error',
                title: 'Erreur de saisie',
                text: 'Veuillez remplir tous les champs obligatoires!',
            });
        }else if (!validateEmail(email)) {
            Swal.fire({
                title: 'Error!',
                text: "Email nom valide",
                icon: 'error',
                confirmButtonText: 'Ok'
            });
        }else if (!validateNom(nom)) {
            Swal.fire({
                title: 'Error!',
                text: "Le nom doit contenier uniquement des lettres",
                icon: 'error',
                confirmButtonText: 'Ok'
            });
        }else if(!validateNomOrg(nom_org)) {
            Swal.fire({
                title: 'Error!',
                text: "Le nom d'entrprise seulement des lettres et des chiffres.",
                icon: 'error',
                confirmButtonText: 'Ok'
            });
        } else if (!validateCP(code_postal)) {
            Swal.fire({
                title: 'Error!',
                text: "Le code postal doitcontenir seulement des lettres et nombre de chiffre max 5.",
                icon: 'error',
                confirmButtonText: 'Ok'
            });
        } else {
            //verification de existance
            axios.post('/verification', {
                nom_org: nom_org,
                nom:nom,
                prenom:prenom
                }).then(response => {
                    if (response.data.organisationExist) {
                        Swal.fire({
                            title: 'Erreur!',
                            text: response.data.msgOrganisation,
                            icon: 'error',
                            confirmButtonText: 'Ok'
                        });
                    }else if (response.data.contactExist) {
                        Swal.fire({
                                title: response.data.msgContact,
                                icon: 'error',
                                showCancelButton: true,
                                confirmButtonText: "Ajouter",
                                cancelButtonText:"annuler"
                            }).then((result) => {
                                if (result.isConfirmed) {
                                    var form = document.getElementById("addContactForm");
                                    form.submit();
                                }
                            });
                    }else if (!response.data.contactExist && !response.data.organisationExist) {
                        var form = document.getElementById("addContactForm");
                        form.submit();
                    }

                }).catch(error => {
                    console.log(error);
            });
        }



    });
    const validateEmail = (email) => {
        return email.match(
        /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
        );
    };
    const validateNom = (nom) => {
        return /^[a-zA-Z\s]+$/.test(nom);
    };
    const validatePrenom = (prenom) => {
        return /^[a-zA-Z\s]+$/.test(prenom);
    };
    const validateNomOrg = (nom_org) => {
        return /^[a-zA-Z0-9\s]+$/.test(nom_org);
    };
    const validateCP = (cp) => {
        return /^[0-9]{4,5}$/.test(cp);
    };

    </script>
@endsection
