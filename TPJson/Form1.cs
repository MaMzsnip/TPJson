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
using System.Web.Script.Serialization;

namespace TPJson
{
    public partial class Form1 : Form
    {
        public Form1()
        {
            InitializeComponent();
        }

        private async void Form1_LoadAsync(object sender, EventArgs e)
        {
            this.addJsonInListBox("http://172.19.0.13/tpjson/client.php", "numeroTelephone", listBox1);
            this.addJsonInListBox("http://172.19.0.13/tpjson/facture.php", "numero_Client", listBox2);
            this.addJsonInListBox("http://172.19.0.13/tpjson/produit.php", "prixUnitaire", listBox3);
        }

        private async void addJsonInListBox(string url, string delimiter, ListBox listBox)
        {
            HttpClient clientHttp = new HttpClient();

            UriBuilder builder = new UriBuilder(url);
            string builderUri = builder.ToString();

            var res = await clientHttp.GetAsync(builderUri);

            var content = await res.Content.ReadAsStringAsync();
            dynamic dataClientJson = new JavaScriptSerializer().Deserialize<dynamic>(content);

            for (int i = 0; i < dataClientJson.Length; i++)
            {
                String concatValue = "";
                foreach (KeyValuePair<string, object> kvp in dataClientJson[i])
                {
                    Client client = new Client();
                    if (kvp.Key == delimiter)
                    {
                        Console.WriteLine(kvp.Key + " " + kvp.Value);
                        concatValue += kvp.Key + " " + kvp.Value;
                        listBox.Items.Add(concatValue);
                        concatValue = "";
                    }
                    else
                    {
                        concatValue += kvp.Key + " " + kvp.Value + " ";
                    }
                }
            }
        }

        private async void button1_Click(object sender, EventArgs e)
        {
            Client clientObj = new Client(clientLastName.Text, this.clientName.Text, clientAddress.Text, clientCodePostal.Text, clientCity.Text, clientPhoneNumber.Text);
            HttpClient client = new HttpClient();

            string json = new JavaScriptSerializer().Serialize(clientObj);
            var data = new StringContent(json, Encoding.UTF8, "application/json");
            var builder = new UriBuilder("http://172.19.0.13/tpjson/create_client.php");
            var builderUri = builder.ToString();

            var res = await client.PostAsync(builderUri, data);

            var content = await res.Content.ReadAsStringAsync();
            dynamic dataJson = new JavaScriptSerializer().Deserialize<dynamic>(content);
        }

        private async void button2_Click(object sender, EventArgs e)
        {
            Produit produitObj = new Produit(produitRef.Text, produitLibelle.Text, Convert.ToSingle(produitPrix.Text));
            HttpClient client = new HttpClient();

            string json = new JavaScriptSerializer().Serialize(produitObj);
            var data = new StringContent(json, Encoding.UTF8, "application/json");
            var builder = new UriBuilder("http://172.19.0.13/tpjson/create_produit.php");
            var builderUri = builder.ToString();

            var res = await client.PostAsync(builderUri, data);

            var content = await res.Content.ReadAsStringAsync();
            dynamic dataJson = new JavaScriptSerializer().Deserialize<dynamic>(content);
        
        }
    }
}
