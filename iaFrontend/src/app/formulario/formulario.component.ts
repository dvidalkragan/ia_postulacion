import { Component } from '@angular/core';
import { ToastrService } from 'ngx-toastr';
import { ApplicantService } from '../services/applicant.service';
import { Applicant } from '../interfaces/applicant';

@Component({
  selector: 'app-formulario',
  templateUrl: './formulario.component.html',
  styleUrls: ['./formulario.component.css']
})
export class FormularioComponent {

  persona : Applicant = {
    nombre:null,
    telefono:null,
    rut: null,
    email:null
  };

  constructor(private toastr: ToastrService, private applicantService: ApplicantService) {
  }

//Esta funcion me permite tomar y validar en el FrontEnd los datos aportados por el usuario
//Estoy muy conciente que puede haber una mejor manera de validacion de formularios,
//pero dada mi expertiz y rapidez que debia tener para entregar la solución, creo que cumple con
//lo pedido. Ademas muestra con la funcionalidad Toastr si existe un error o se realizo todo ok.
  postData() {
    let messages:any = [];

    if(this.is_empty(this.persona.nombre)) {
      messages.push("El nombre es obligatorio");
    }
    if(this.is_empty(this.persona.telefono)) {
      messages.push("El telefono es obligatorio");
    }
    if(this.is_empty(this.persona.email)) {
      messages.push("El email es obligatorio");
    }
    if(this.is_empty(this.persona.rut)) {
      messages.push("El rut es obligatorio");
    }

    if(messages.length === 0) {
      this.applicantService.store(this.persona).subscribe((data) => {
        this.toastr.success('Subscripción exitosa!', "FrontEnd DV");
        console.log(data);
      },
      (error) => {
            this.toastr.error("Backend Respondió: " + error.error.error, "FrontEnd DV");
      });
    }
    else {
      for(let i=0; i<messages.length; i++) {
        this.toastr.warning(messages[i], "FrontEnd DV");
      }
    }
  }

  is_empty(data) {
    if(data === null || data === undefined || data === "") {
      return true;
    }
    return false;
  }
}
