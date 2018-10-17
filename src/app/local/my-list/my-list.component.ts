import { Component, OnInit } from '@angular/core';

import { LocalService } from '../local.service';

@Component({
  selector: 'app-my-list',
  templateUrl: './my-list.component.html',
  styleUrls: ['./my-list.component.css']
})

export class MyListComponent implements OnInit {

  myCards = [];

  constructor(
    private LocalService: LocalService
  ) {}

  ngOnInit() {

  }

  cards(){
    this.myCards = this.LocalService.cards();
    console.log(this.myCards);
    return "";
  }
}
