using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
using ConsumirApi.Models;
using ConsumirApi.Services;

namespace ConsumirApi.Controllers
{
    class AlumnosController 
    {
       private AlumnosServices objAlumnos = new AlumnosServices();

        public async Task<ResultAuth> IniciarSesion(object data)
        {
            var obj = await  objAlumnos.IniciarSesion(data);


            if (obj!=null)
            {
                string jsonString = obj.Content.ReadAsStringAsync().Result;
               
                if (obj.StatusCode == System.Net.HttpStatusCode.OK)
                {
                    

                    return Newtonsoft.Json.JsonConvert.DeserializeObject<ResultAuth>(jsonString);


                }
                else
                {
                    
                    MessageBox.Show(jsonString, "Atencion"); 
                }

            }
            return null;

        }


        public async Task<ResultData<AlumnosModel>> ObtenerAlumnosRegistrados(TokenModel data)
        {
            var obj = await objAlumnos.ObtenerAlumnosRegistrados(data);


            if (obj != null)
            {
                string jsonString = obj.Content.ReadAsStringAsync().Result;

                if (obj.StatusCode == System.Net.HttpStatusCode.OK)
                {
                    var info = Newtonsoft.Json.JsonConvert.DeserializeObject<ResultData<AlumnosModel>>(jsonString);

                    return info;
                }
                
      

            }


            return null;
        }

        public async Task<Result<AlumnosModel>> ObtenerAlumnoEspecifico(object data,TokenModel token)
        {
            var obj = await objAlumnos.ObtenerAlumnosEspecifico(data,token);


            if (obj != null)
            {
                string jsonString = obj.Content.ReadAsStringAsync().Result;
              


                if (obj.StatusCode == System.Net.HttpStatusCode.OK)
                {
                    var info = Newtonsoft.Json.JsonConvert.DeserializeObject<Result<AlumnosModel>>(jsonString);
                    

                    return info;
                }
                   
                 else
                {
                    MessageBox.Show(jsonString, "Atencion");
                }






            }


            return null;
        }


    }
}
