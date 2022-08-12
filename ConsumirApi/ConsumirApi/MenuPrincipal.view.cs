using ConsumirApi.Controllers;
using ConsumirApi.Models;
using System;
using System.Windows.Forms;

namespace ConsumirApi
{
    public partial class MenuPrincipal : Form
    {
        dynamic objAlumnos = new AlumnosModel();
        TokenModel token = new TokenModel();
        AlumnosController controller = new AlumnosController();
        public MenuPrincipal(object objAlumnos, TokenModel token)
        {
            this.objAlumnos = objAlumnos;
            this.token = token;
            InitializeComponent();
        }

     
        public async void ObtenerAlumnos()
        {
            var obj = await controller.ObtenerAlumnosRegistrados(token);
            dataGridView2.Rows.Clear();
            if (obj != null)
            {
                foreach (var data in obj.data)
                {
                    dataGridView2.Rows.Add(data.NumCuenta, data.Nombres, data.ApellidoPaterno, data.ApellidoMaterno, data.Correo,data.Curp, data.Telefono, data.Domicilio, data.CodigoPostal, data.Discapacidad, data.AfiliacionImss,data.ID_ROL, data.Estatus);

                }
            }
         
        }

        public async void ObtenerAlumnoEspecifico(object data)
        {
           var obj = await controller.ObtenerAlumnoEspecifico(data, token);
            
            if (obj != null)
            {
               
                
                dataGridView2.Rows.Clear();
                dataGridView2.Rows.Add(obj.data.NumCuenta,obj.data.Nombres, obj.data.ApellidoPaterno, obj.data.ApellidoMaterno,obj.data.Correo,obj.data.Curp,obj.data.Telefono,obj.data.Domicilio,obj.data.CodigoPostal,obj.data.Discapacidad,obj.data.AfiliacionImss,obj.data.ID_ROL,obj.data.Estatus);


            }
   





            

        
        }

        private void MenuPrincipal_Load_1(object sender, EventArgs e)
        {
            lblDatos.Text += objAlumnos["Nombres"] + " " + objAlumnos["ApellidoPaterno"] + " " + objAlumnos["ApellidoMaterno"];
            ObtenerAlumnos();
        }

        private void button1_Click(object sender, EventArgs e)
        {
            this.Hide();
            IniciarSesion iniciar = new IniciarSesion();
            iniciar.Show();
        }

        private void btn_Buscar_Click(object sender, EventArgs e)
        {
            ObtenerAlumnoEspecifico(new { NumCuenta = NUD_NumCuenta.Value });
        }

        private void groupBox1_Enter(object sender, EventArgs e)
        {

        }

        private void btn_Actualizar_Click(object sender, EventArgs e)
        {
            ObtenerAlumnos();

        }

        private void dataGridView2_CellContentClick(object sender, DataGridViewCellEventArgs e)
        {
                }

        private void dataGridView2_CellEndEdit(object sender, DataGridViewCellEventArgs e)
        {
           




            controller.ModificarAlumno(new { NumeroCuenta = dataGridView2.Rows[e.RowIndex].Cells[0].Value, Nombres = dataGridView2.Rows[e.RowIndex].Cells[1].Value, ApellidoPaterno = dataGridView2.Rows[e.RowIndex].Cells[2].Value, ApellidoMaterno = dataGridView2.Rows[e.RowIndex].Cells[3].Value, Correo = dataGridView2.Rows[e.RowIndex].Cells[4].Value, CURP = dataGridView2.Rows[e.RowIndex].Cells[5].Value, Telefono = dataGridView2.Rows[e.RowIndex].Cells[6].Value, Domicilio = dataGridView2.Rows[e.RowIndex].Cells[7].Value, CodigoPostal= dataGridView2.Rows[e.RowIndex].Cells[8].Value,Discapacidad= dataGridView2.Rows[e.RowIndex].Cells[9].Value, Afiliacion_IMSS = dataGridView2.Rows[e.RowIndex].Cells[10].Value, ID_ROL=dataGridView2.Rows[e.RowIndex].Cells[11].Value, Estatus= dataGridView2.Rows[e.RowIndex].Cells[12].Value }, token) ;
            ObtenerAlumnos();
        }
    }
}
