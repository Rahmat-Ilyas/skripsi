using Npgsql;
using System;
using System.Windows.Forms;

namespace MaccaMart
{
    static class Program
    {
        /// <summary>
        /// The main entry point for the application.
        /// </summary>
        [STAThread]
        static void Main()
        {
            string connstring = @"Server=localhost;Port=5444;Userid=mainpower;Password=;Database=i5_MaccaMart";
            NpgsqlConnection conn = new NpgsqlConnection(connstring);
            conn.Open();

            string sql = "SELECT * FROM tbl_item";
            var cmd = new NpgsqlCommand(sql, conn);

            NpgsqlDataReader reader = cmd.ExecuteReader();

            while (reader.Read())
            {
                // Console.WriteLine(reader.GetString(0));
            }

            Application.EnableVisualStyles();
            Application.SetCompatibleTextRenderingDefault(false);
            Application.Run(new Form1());
        }
    }
}
