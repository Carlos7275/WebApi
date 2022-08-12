using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.IdentityModel.Tokens.Jwt;
using System.Linq;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
using ConsumirApi.Controllers;
using ConsumirApi.Models;
using ConsumirApi.Services;


namespace ConsumirApi
{
    
    public partial class IniciarSesion : Form

    {
        AlumnosController controller = new AlumnosController();

        public IniciarSesion()
        {
            InitializeComponent();
        }



        private  async void btn_Login_Click(object sender, EventArgs e)
        {
           

            ResultAuth result = await controller.IniciarSesion(new { NumCuenta = NUD_NumCuenta.Value, Password = txt_Password.Text });

            if (result != null)
            {
            

                var obj =  new JwtSecurityToken(result.data.ToString()).Payload;

                 if (Convert.ToInt16(obj["status"]) == 200)
                 {

                var datos = JwtPayload.Deserialize(obj["data"].ToString());
                    var Token = new TokenModel() { Token = result.data.ToString() };
                    this.Hide();
                    MenuPrincipal menuPrincipal = new MenuPrincipal(datos,Token);

                    menuPrincipal.Show();






                }





                }
         







        }

     
        private void txt_Salir_Click(object sender, EventArgs e)
        {
            this.Close();
        }
    }
}
