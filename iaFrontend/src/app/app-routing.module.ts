import { NgModule } from '@angular/core';
import { Routes, RouterModule, Router, PreloadAllModules } from '@angular/router';
import { AppComponent } from './app.component';
import { FormularioMovilComponent } from './formulario-movil/formulario-movil.component';
import { ApplicationStateService } from './services/application-state.service';

//Rutas optimizadas para desktop
const desktop_routes: Routes = [
  {path:'', component: AppComponent},
  {path:'movile', component:FormularioMovilComponent}
];

//Rutas "optimizadas" para dispositivos moviles
const mobile_routes: Routes = [
  {path:'', component:FormularioMovilComponent}
];

@NgModule({
  imports: [RouterModule.forRoot(desktop_routes,{preloadingStrategy: PreloadAllModules})],
  exports: [RouterModule]
})
export class AppRoutingModule {

  public constructor(private router: Router,
      private applicationStateService: ApplicationStateService) {

//La idea era que con este servicio se pudiese detectar la resolucion del dispositivo
//y haga el cambio directamente a mobile_routes
      if (applicationStateService.getIsMobileResolution()) {
        router.resetConfig(mobile_routes);
      }
    }

}
