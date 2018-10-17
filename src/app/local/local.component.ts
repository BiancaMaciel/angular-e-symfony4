import { Component, OnInit } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';
import { Http, Headers, RequestOptions } from '@angular/http';


import { LocalService } from './local.service';
// import { Subscription, Subscribe } from 'rxjs';

@Component({
  selector: 'app-local',
  templateUrl: './local.component.html',
  styleUrls: ['./local.component.css']
})
export class LocalComponent implements OnInit {

  city = '';
  myList = [];

  constructor(
   private LocalService: LocalService
  ) {}

  ngOnInit() {
  }

  buscar(){
    this.LocalService.find(this.city);
  }

}
