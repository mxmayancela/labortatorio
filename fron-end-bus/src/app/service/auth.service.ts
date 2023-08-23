import { Injectable } from '@angular/core';

@Injectable({
  providedIn: 'root'
})
export class AuthService {
  private authTokenKey = 'authToken';

  constructor() { }

  public saveAuthToken(token: string): void {
    localStorage.setItem(this.authTokenKey, token);
  }

  public getAuthToken(): string | null {
    return localStorage.getItem(this.authTokenKey);
  }

  public clearAuthToken(): void {
    localStorage.removeItem(this.authTokenKey);
  }

  public isAuthenticated(): boolean {
    const authToken = this.getAuthToken();
    return !!authToken; // Verificar si existe un token de autenticación
  }
}
