import { Component, OnInit, ViewChild } from '@angular/core';
import { MatPaginator } from '@angular/material/paginator';
import { MatSort } from '@angular/material/sort';
import { MatTableDataSource } from '@angular/material/table';
import { Router } from '@angular/router';
import { NgToastService } from 'ng-angular-popup';
import { NgConfirmService } from 'ng-confirm-box';
import { Carrier } from 'src/app/models/carrier';
import { CarrierService } from 'src/app/service/carrier.service';

@Component({
  selector: 'app-list-carrier',
  templateUrl: './list-carrier.component.html',
  styleUrls: ['./list-carrier.component.scss']
})
export class ListCarrierComponent implements OnInit {
  public carriers!: Carrier[]
  dataSource!: MatTableDataSource<Carrier>;
  displayedColumns: string[] = ['id', 'license','name', 'lastnamefather','lastnamemother','cedula','birthdate','action'];
  @ViewChild(MatPaginator) paginator!: MatPaginator;
  @ViewChild(MatSort) sort!: MatSort;
  constructor(private apiService: CarrierService, private router: Router, private confirmService: NgConfirmService, private toastService: NgToastService) { }

  ngOnInit() {
    this.getCarriers();
  }

  edit(id: number) {
    this.router.navigate(['carrier/update', id])
  }
  getCarriers() {
    this.apiService.getCarriers()
      .subscribe({
        next: (res) => {
          this.carriers = res.data;
          this.dataSource = new MatTableDataSource(this.carriers);
          // this.dataSource.paginator = this.paginator;
          // this.dataSource.sort = this.sort;
        },
        error: (err) => {
          console.log(err);
        }
      })
  }
  

}
