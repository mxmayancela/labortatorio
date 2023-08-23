import { Component, OnInit, ViewChild } from '@angular/core';
import { MatPaginator } from '@angular/material/paginator';
import { MatSort } from '@angular/material/sort';
import { MatTableDataSource } from '@angular/material/table';
import { Router } from '@angular/router';
import { NgToastService } from 'ng-angular-popup';
import { NgConfirmService } from 'ng-confirm-box';
import { Bus } from 'src/app/model/bus';
import { BusService } from 'src/app/service/bus.service';

@Component({
  selector: 'app-list-bus',
  templateUrl: './list-bus.component.html',
  styleUrls: ['./list-bus.component.scss']
})
export class ListBusComponent {
  public buses!: Bus[]
  dataSource!: MatTableDataSource<Bus>;
  displayedColumns: string[] = ['id', 'licenseplate','unitnumber', 'capacity','carrier','year','model','action'];
  @ViewChild(MatPaginator) paginator!: MatPaginator;
  @ViewChild(MatSort) sort!: MatSort;
  constructor(private apiService: BusService, private router: Router, private confirmService: NgConfirmService, private toastService: NgToastService) { }

  ngOnInit() {
    this.getBuses();
  }

  edit(id: number) {
    this.router.navigate(['bus/update', id])
  }
  getBuses() {
    this.apiService.getBuses()
      .subscribe({
        next: (res) => {
          this.buses = res.data;
          console.log(this.buses);
          this.dataSource = new MatTableDataSource(this.buses);
          // this.dataSource.paginator = this.paginator;
          // this.dataSource.sort = this.sort;
        },
        error: (err) => {
          console.log(err);
        }
      })
  }
}
