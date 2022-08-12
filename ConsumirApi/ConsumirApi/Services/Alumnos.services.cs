using ConsumirApi.Models;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Net.Http;
using System.Net.Http.Headers;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;

namespace ConsumirApi.Services
{
    class AlumnosServices:IDisposable
    {
        private string urlApi="http://localhost/WebApi/";
        private  static HttpClient cliente = new HttpClient();

        public async Task<HttpResponseMessage> IniciarSesion(object data)
        {
      
            cliente.DefaultRequestHeaders.Accept.Add(
                new MediaTypeWithQualityHeaderValue("application/json"));

            
         
                var json = Newtonsoft.Json.JsonConvert.SerializeObject(data);
                var content = new StringContent(json, Encoding.UTF8, "application/json");
                var result = await cliente.PostAsync(urlApi+"?u=IniciarSesion",content);

            cliente = new HttpClient();
            cliente.DefaultRequestHeaders.ProxyAuthorization = null;


            return result;
                

            
            
          

        }

        public async Task<HttpResponseMessage> ObtenerAlumnosRegistrados (TokenModel data)
        {
         
            cliente.DefaultRequestHeaders.Accept.Add(
                new MediaTypeWithQualityHeaderValue("application/json"));
            cliente.DefaultRequestHeaders.Authorization = new AuthenticationHeaderValue( data.Token);


         
            var json = Newtonsoft.Json.JsonConvert.SerializeObject(data);
            var content = new StringContent(json, Encoding.UTF8, "application/json");
            var result = await cliente.PostAsync(urlApi + "?u=ObtenerAlumnos",content);

            cliente = new HttpClient();
            cliente.DefaultRequestHeaders.ProxyAuthorization = null;


            return result;






        }

        public async Task<HttpResponseMessage> ObtenerAlumnosEspecifico(object data,TokenModel token)
        {
     
            cliente.DefaultRequestHeaders.Accept.Add(
                new MediaTypeWithQualityHeaderValue("application/json"));
            cliente.DefaultRequestHeaders.Authorization = new AuthenticationHeaderValue(token.Token);



            var json = Newtonsoft.Json.JsonConvert.SerializeObject(data);
            var content = new StringContent(json, Encoding.UTF8, "application/json");
            var result = await cliente.PostAsync(urlApi + "?u=ObtenerAlumnoEspecifico", content);

            cliente = new HttpClient();
            cliente.DefaultRequestHeaders.ProxyAuthorization = null;


            return result;






        }

        public void Dispose()
        {
            throw new NotImplementedException();
        }
    }
}
