import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Applicant } from '../interfaces/applicant';

@Injectable({
  providedIn: 'root'
})
export class ApplicantService {

  API_Laravel = 'http://localhost:8000/api/v1/';

  constructor(private httpClient: HttpClient) { }

 //Este metodo del servicio me permite hacer el post a la API
  store(applicant: Applicant) {
    const headers = new HttpHeaders({"Content-Type":"application/json"});
    return this.httpClient.post(this.API_Laravel + "landing/subscriptions/", applicant, {headers: headers});
  }
}
