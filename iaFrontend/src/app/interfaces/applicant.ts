//Interfaz que me permite mantener ordenada la informacion
//para ser posteada a la API del Backend en Laravel 5.8
export interface Applicant {
  id?:string;
  nombre:string;
  email:string;
  telefono:string;
  rut:string;
}
