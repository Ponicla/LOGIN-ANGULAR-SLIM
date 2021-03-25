import { NgModule } from '@angular/core';
import { Routes, RouterModule } from '@angular/router';
import { LoginComponent } from '../app/components/user/login/login.component';
import { HomeComponent } from '../app/components/app/home/home.component';

/* Guards */
import { LoginGuard } from '../app/guards/login/login.guard';  

const routes: Routes = [
  { path: '' , redirectTo: 'home', pathMatch: 'full', canActivate: [LoginGuard] },
  { path: 'home',  component: HomeComponent, canActivate: [LoginGuard] },
  { path: 'login', component: LoginComponent }, 
];

@NgModule({
  imports: [RouterModule.forRoot(routes)],
  exports: [RouterModule]
})
export class AppRoutingModule { }
