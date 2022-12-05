using System;
using System.Collections.Generic;
using System.Linq;
using System.Text;
using System.Threading.Tasks;

namespace TPJson
{
    class Produit
    {
        public string reference;
        public string libelle;
        public float prixUnitaire;

        public string Reference { get => reference; set => reference = value; }
        public string Libelle { get => libelle; set => libelle = value; }
        public float PrixUnitaire { get => prixUnitaire; set => prixUnitaire = value; }

        public Produit(string reference, string libelle, float prixUnitaire)
        {
            this.Reference = reference;
            this.Libelle = libelle;
            this.PrixUnitaire = prixUnitaire;
        }
    }
}
