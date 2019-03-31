import { Component, OnInit } from '@angular/core';
import { ToastrService } from 'ngx-toastr';
import { ApplicantService } from '../services/applicant.service';
import { Applicant } from '../interfaces/applicant';

@Component({
  selector: 'app-formulario-movil',
  templateUrl: './formulario-movil.component.html',
  styleUrls: ['./formulario-movil.component.css']
})
export class FormularioMovilComponent implements OnInit {

  title1 = 'Cursos de';
  title2 = 'Verano Pro';

  description = 'No dejes pasar esta increible oportunidad. Inscribete acá';

  persona : Applicant = {
    nombre:null,
    telefono:null,
    rut: null,
    email:null
  };

  constructor(private toastr: ToastrService, private applicantService: ApplicantService) { }

  ngOnInit() {
  }

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
