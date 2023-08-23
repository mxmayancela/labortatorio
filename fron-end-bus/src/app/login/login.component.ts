import { Component, OnInit } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { Router } from '@angular/router';
import { NgForm } from '@angular/forms';
import { AuthService } from '../service/auth.service';


@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})

export class LoginComponent implements OnInit {

  constructor(private http:HttpClient, private router:Router,private authService:AuthService) {}
  ngOnInit(): void {
  }

  onSubmit(form:NgForm) {
    const email = form.value.email;
    const password = form.value.password;


    this.http.post('http://localhost:8000/api/auth/login',{
      email:email,
      password:password
    })
      .subscribe((response:any) => {
        const token = response.data.token;
        this.authService.saveAuthToken(token);
       this.router.navigate(['dashboard']);
      }, error => {
        console.log(error);
      });
  }
}
