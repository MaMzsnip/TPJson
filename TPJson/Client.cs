using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace TPJson
{
    class Client
    {
        public string name;
        public string lastName;
        public string address;
        public string postalCode;
        public string city;
        public string numberPhone;

        public string Name { get => name; set => name = value; }
        public string LastName { get => lastName; set => lastName = value; }
        public string Address { get => address; set => address = value; }
        public string PostalCode { get => postalCode; set => postalCode = value; }
        public string City { get => city; set => city = value; }
        public string NumberPhone { get => numberPhone; set => numberPhone = value; }

        public Client(string name, string lastName, string address, string postalCode, string city, string numberPhone)
        {
            this.Name = name;
            this.LastName = lastName;
            this.Address = address;
            this.PostalCode = postalCode;
            this.City = city;
            this.NumberPhone = numberPhone;
        }

        

        public Client() { }
    }
}
