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

        public async void ModificarAlumno(object data,TokenModel token)
        {
            var obj = await objAlumnos.ModificarAlumno(data,token);


            if (obj != null)
            {
                
                string jsonString = obj.Content.ReadAsStringAsync().Result;

                var objdata = Newtonsoft.Json.JsonConvert.DeserializeObject<ResultAuth>(jsonString);
                
                if (Convert.ToInt16(objdata.Status)== 200)
                {
                    MessageBox.Show(objdata.data, objdata.Message,MessageBoxButtons.OK,MessageBoxIcon.Information);
                }
                 else
                    MessageBox.Show(objdata.data, objdata.Message, MessageBoxButtons.OK, MessageBoxIcon.Error);


            }


        
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
