using System;
using System.Collections.Generic;
using System.ComponentModel;
using System.Data;
using System.Drawing;
using System.Linq;
using System.Net.Http;
using System.Text;
using System.Threading.Tasks;
using System.Windows.Forms;
using Npgsql;

namespace MaccaMart
{
    public partial class Form1 : Form
    {
        public Form1()
        {
            InitializeComponent();
            this.MaximizeBox = false;
        }
        private void sinkron()
        {
            string connstring = @"Server=localhost;Port=5444;Userid=mainpower;Password=;Database=i5_MaccaMart";
            NpgsqlConnection conn = new NpgsqlConnection(connstring);
            conn.Open();

            string sql = "SELECT * FROM tbl_item";
            var cmd = new NpgsqlCommand(sql, conn);

            NpgsqlDataReader reader = cmd.ExecuteReader();

            Console.WriteLine(reader.Read());

            while (reader.Read())
            {
                Console.WriteLine(reader.GetString(0));
            }

            //var client = new HttpClient();
            //var endpoint = new Uri("");
        }

        private void label1_Click(object sender, EventArgs e)
        {

        }

        private void button1_Click(object sender, EventArgs e)
        {
            sinkron();
        }

        private void Form1_Load(object sender, EventArgs e)
        {
            comboBox1.SelectedItem = "Tidak Aktif";
        }

        private void pictureBox1_Click(object sender, EventArgs e)
        {

        }

        private void tableLayoutPanel1_Paint(object sender, PaintEventArgs e)
        {

        }

        private void label4_Click(object sender, EventArgs e)
        {

        }

        private void comboBox1_SelectedIndexChanged(object sender, EventArgs e)
        {

        }

        private void dataGridView1_CellContentClick(object sender, DataGridViewCellEventArgs e)
        {

        }
    }
}
