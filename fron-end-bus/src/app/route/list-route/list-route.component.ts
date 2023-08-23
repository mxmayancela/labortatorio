import { Component, ViewChild } from '@angular/core';
import { MatPaginator } from '@angular/material/paginator';
import { MatSort } from '@angular/material/sort';
import { MatTableDataSource } from '@angular/material/table';
import { Router } from '@angular/router';
import { NgToastService } from 'ng-angular-popup';
import { NgConfirmService } from 'ng-confirm-box';
import { Route } from 'src/app/model/route';
import { RouteService } from 'src/app/service/route.service';

@Component({
  selector: 'app-list-route',
  templateUrl: './list-route.component.html',
  styleUrls: ['./list-route.component.scss']
})
export class ListRouteComponent {
  public routes!: Route[];
  dataSource!: MatTableDataSource<Route>;
  displayedColumns: string[] = [
    'id', 
    'city_origin', 
    'city_destination',
    'bus',
    'carrier',
    'date',
    'start_time',
    'date_end',
    'end_time',
    'complete',
    'action',
  ];
  @ViewChild(MatPaginator) paginator!: MatPaginator;
  @ViewChild(MatSort) sort!: MatSort;

  constructor(private apiService:RouteService, private router:Router, private confirmService: NgConfirmService, private toastService: NgToastService) { }

  ngOnInit() {
    this.getRoutes();
  }

  edit(id: number) {
    this.router.navigate(['route/update', id])
  }

  getRoutes() {
    this.apiService.getRoutes()
      .subscribe({
        next: (res) => {
          this.routes = res.data;
          this.dataSource = new MatTableDataSource(this.routes);
          // this.dataSource.paginator = this.paginator;
          // this.dataSource.sort = this.sort;
        },
        error: (err) => {
          console.log(err);
        }
      })
  }
}
