import { Injectable } from '@angular/core';
import { Http, Headers, RequestOptions } from '@angular/http';

import 'rxjs/add/operator/map';

@Injectable({
  providedIn: 'root'
})
export class LocalService {

  constructor( private Http:Http ) {}

  city = '';
  myList = [];

  private url = '';

  find(city){
    this.city = city;
    if(this.city){
      var url = `http://localhost:8000/weather/${this.city}`;
      return this.Http.get(url)
             .map(response => response.json())
             .subscribe(response=>{
              //  console.log(JSON.stringify(response));
               this.myList = response.items;
               return this.myList;
             })
    }
  }

  cards(){
    if(this.myList){
      console.log(this.myList);
      return this.myList;
    }
  }
}
