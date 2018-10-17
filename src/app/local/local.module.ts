import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { FormsModule } from '@angular/forms';

import { LocalComponent } from './local.component';
import { MyListComponent } from './my-list/my-list.component';
import { LocalService } from './local.service';

@NgModule({
  imports: [
    CommonModule,
    FormsModule
  ],
  exports: [LocalComponent, MyListComponent],
  declarations: [LocalComponent, MyListComponent],
  providers: [LocalService],
  bootstrap: [LocalComponent]
})
export class LocalModule { }
