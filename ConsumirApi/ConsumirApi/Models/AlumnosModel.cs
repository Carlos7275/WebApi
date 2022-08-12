using System;
using System.Collections.Generic;
using System.IdentityModel.Tokens.Jwt;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace ConsumirApi.Models
{
   public class AlumnosModel
    {

        public int NumCuenta { get; set; }
        public string Nombres { get; set; }
        public string ApellidoPaterno { get; set; }
        public string ApellidoMaterno { get; set; }
        public string Correo { get; set; }
        public string Telefono { get; set; }
        public string Domicilio { get; set; }
        public string CodigoPostal { get; set; }
        public string AfiliacionImss { get; set; }
        public int Discapacidad { get; set; }
        public int ID_ROL { get; set; }
        public string Estatus { get; set; }

    }
}
