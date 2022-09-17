using Npgsql;
using System;
using System.Windows.Forms;
using System.Data;
using System.Linq;

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
            DataTable dt = new DataTable();
            string[] arrray = dt.Rows.OfType<DataRow>().Select(k => k[0].ToString()).ToArray();
            dt.Load(reader);
            dataGridView1.DataSource = dt;

            foreach (var item in arrray)
            {
                Console.WriteLine(item.ToString());
            }
            //Console.WriteLine(reader.Read());

            //String[] myArray;
            //String myJSON = "";
            //int i = 0;
            //while (reader.Read())
            //{
            //    //myArray = reader.GetValues();
            //    // myArray = new string[] reader.GetValues();
            //    // double[] myArray = (double[])reader.GetValue(0);
            //    myJSON += "{";
            //    for (int idx = 0; idx < reader.FieldCount; idx++)
            //    {
            //        myArray = (String[])reader.GetValue(0);
            //        // Console.Write(reader.GetName(idx) + " => " + reader[idx]);
            //        // arrayKu[i] = "ds";
            //        myJSON += '"' + reader.GetName(idx) + '"' + " : " + '"' + reader[idx] + '"' + ',';
            //        // termsList.Add(reader.GetName(idx));
            //    }
            //    myJSON += "}, ";
            //    // Console.WriteLine();

            //    i++;
            //}

            //String[] terms = termsList.ToArray();
            // Console.WriteLine(myJSON);
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
