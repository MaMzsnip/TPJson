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
                string concatValue = "";
                foreach (KeyValuePair<string, object> kvp in dataClientJson[i])
                {
                    if (kvp.Key == delimiter)
                    {
                        concatValue += kvp.Key + ":" + kvp.Value;
                        listBox.Items.Add(concatValue);
                        concatValue = "";
                    }
                    else
                    {
                        concatValue += kvp.Key + ":" + kvp.Value + ";";
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

        private async void button3_Click(object sender, EventArgs e)
        {
            string lineSelected = (string)listBox1.SelectedItem;

            int numeroClient = Convert.ToInt32(lineSelected.Split(';')[0].Split(':')[1]);
            string json = "{\"numeroClient\":" + numeroClient + ", \"produits\":[";

            foreach (string item in listBox3.SelectedItems)
            {
                string reference = item.Split(';')[0].Split(':')[1];
                //reference:SBMA;libelle:Beef - Ground, Extra Lean, Fresh;prixUnitaire:10
                if ((listBox3.SelectedItems.IndexOf(item) + 1) == listBox3.SelectedItems.Count)
                {
                    json += "\"" + reference + "\"";
                    break;
                }
                json += "\"" + reference + "\",";
            }

            json += "]}";

            HttpClient client = new HttpClient();
            var data = new StringContent(json, Encoding.UTF8, "application/json");
            var builder = new UriBuilder("http://172.19.0.13/tpjson/create_facture.php");
            var builderUri = builder.ToString();

            var res = await client.PostAsync(builderUri, data);

            var content = await res.Content.ReadAsStringAsync();
            dynamic dataJson = new JavaScriptSerializer().Deserialize<dynamic>(content);

        }
    }
}
