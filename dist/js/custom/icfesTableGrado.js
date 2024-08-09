document.addEventListener("DOMContentLoaded", function () {

  function convertirImagenABase64(archivo) {
    return new Promise((resolve, reject) => {
      const lector = new FileReader();
      lector.onloadend = function () {
        resolve(lector.result);
      };
      lector.onerror = function (error) {
        reject(error);
      };
      lector.readAsDataURL(archivo);
    });
  }

  const ruta_img_logo = "dist/img/cpi_logo.png";

  (async () => {

    const response = await fetch(ruta_img_logo);
    const blob = await response.blob();
    const img_logo_base64 = await convertirImagenABase64(blob);
    const img_logo = img_logo_base64;

    const btnPdf = document.querySelector("#btn-pdf");

    btnPdf.addEventListener("click", function () {
      $('#cortina-de-espera').attr('style', 'overflow-y: auto; display:flex;');
      /////////////////////////////////////////////////////////

      const ptMaxTemp = JSON.parse(document.querySelector("#ptj-max").value);
      const ptMax = Object.entries(ptMaxTemp).sort((a, b) => parseFloat(b[1]) - parseFloat(a[1]));

      const ptMat = JSON.parse(document.querySelector("#ptj-mat").value)
      const liMat = JSON.parse(document.querySelector("#ptj-mli").value)

      const crrAnio = document.querySelector("#icfes-anio").value
      const crrgrado = document.querySelector("#alum-grado").value
      const crrOrden = document.querySelector("#simul-orden").value
      const maxPuntaje = Object.keys(liMat).length * 100
      const maxEstudiantes = Object.keys(ptMaxTemp).length

      const totalGeneral = Object.values(ptMaxTemp).reduce((acc, valor) => acc + valor, 0);
      const promedioGrupal = (totalGeneral / maxEstudiantes).toFixed(2);

      const margenes = {
        1: 374,
        2: 365,
        3: 356,
        4: 347,
        5: 339,
        6: 330,
        7: 321
      }

      const numDynamicColumns = Object.keys(liMat).length;
      const totalWidth = margenes[numDynamicColumns]
      const dynamicColumnWidth = numDynamicColumns > 0 ? totalWidth / numDynamicColumns : 0;

      const docDefinition = {
        pageSize: { width: 595.276, height: 841.89 },
        pageOrientation: "portrait",
        pageMargins: [30, 20, 30, 10],
        styles: {
          header: {
            fontSize: 18,
            bold: true,
            margin: [0, 0, 0, 10],
          },
          tableTitulo: {
            bold: true,
            fontSize: 7,
            color: "black",
            fillColor: "#CECECE",
            margin: [0, 3, 0, 3],
            alignment: "center",
          },
          tableSubTitulo: {
            bold: true,
            fontSize: 6,
            color: "black",
            fillColor: "#F2F2F2",
            alignment: "center",
          },
          tableSubTitulo2: {
            bold: true,
            fontSize: 6,
            color: "black",
            fillColor: "#F2F2F2",
            alignment: "center",
          },
          tableTexto: {
            bold: false,
            fontSize: 8,
            color: "black",
            alignment: "center",
          },
          textoFtz: {
            bold: false,
            fontSize: 7,
            color: "black",
            alignment: "center",
          },
          tableTexto2: {
            bold: false,
            fontSize: 7,
            color: "black",
            alignment: "center",
          },
          badgeBajo: {
            background: "#DC3545", // Color de fondo del badge
            color: "white", // Color del texto del badge
            padding: [4, 8], // Ajuste del padding
            border: [1, 1, 1, 1], // Borde del badge
            borderRadius: 10, // Radio del borde
            fontSize: 6,
            bold: true,
          },
          badgeBasico: {
            background: "#FFC107", // Color de fondo del badge
            color: "black", // Color del texto del badge
            padding: [4, 8], // Ajuste del padding
            border: [1, 1, 1, 1], // Borde del badge
            borderRadius: 10, // Radio del borde
            fontSize: 6,
            bold: true,
          },
          badgeAlto: {
            background: "#28A745", // Color de fondo del badge
            color: "white", // Color del texto del badge
            padding: [4, 8], // Ajuste del padding
            border: [1, 1, 1, 1], // Borde del badge
            borderRadius: 10, // Radio del borde
            fontSize: 6,
            bold: true,
          },
          badgeSuperior: {
            background: "#343A40", // Color de fondo del badge
            color: "white", // Color del texto del badge
            padding: [4, 8], // Ajuste del padding
            border: [1, 1, 1, 1], // Borde del badge
            borderRadius: 10, // Radio del borde
            fontSize: 6,
            bold: true,
          },
        },
        content: [],
      };

      const pageContent = [
        {
          table: {
            widths: [80, 70, 35, 35, 35, 30, 30, 65, 70],
            body: [
              [
                {
                  rowSpan: 5,
                  image: img_logo,
                  width: 80,
                  height: 80,
                },
                {
                  text: "SIMULACROS ICFES -  I.E ESCUELA NORMAL SUPERIOR DE OCAÑA",
                  style: "tableTitulo",
                  colSpan: 8,
                  alignment: "center",
                  fontSize: 9,
                },
                {},
                {},
                {},
                {},
                {},
                {},
                {},
              ],

              [
                {},
                {
                  text: "LICENCIA DE FUNCIONAMIENTO",
                  style: "tableSubTitulo",
                  colSpan: 2,
                  alignment: "center"
                },
                {},
                {
                  text: "XXX DEL XX DE JUNIO DE XXX (DANE: 000000000000)",
                  style: "tableTexto",
                  colSpan: 6,
                  alignment: "center"
                },
                {},
                {},
                {},
                {},
                {},
              ],

              [
                {},
                {
                  text: "AÑO ESCOLAR",
                  style: "tableSubTitulo",
                  colSpan: 2,
                  alignment: "center",
                },
                {},
                {
                  text: crrAnio,
                  style: "tableTexto",
                  colSpan: 4,
                  alignment: "center",
                },
                {},
                {},
                {},
                {
                  text: "GRADO",
                  style: "tableSubTitulo",
                  colSpan: 1,
                  alignment: "center",
                },
                {
                  text: crrgrado,
                  style: "tableTexto",
                  colSpan: 1,
                  alignment: "center",
                },
              ],

              [
                {},
                {
                  text: "N° SIMULACRO",
                  style: "tableSubTitulo",
                  colSpan: 2,
                  alignment: "center",
                },
                {},
                {
                  text: `#${crrOrden}`,
                  style: "tableTexto",
                  colSpan: 4,
                  alignment: "center",
                },
                {},
                {},
                {},
                {
                  text: "PUNTAJE MÁXIMO",
                  style: "tableSubTitulo",
                  colSpan: 1,
                  alignment: "center",
                },
                {
                  text: maxPuntaje,
                  style: "tableTexto",
                  colSpan: 1,
                  alignment: "center",
                },
              ],

              [
                {},
                {
                  text: "N° DE ESTUDIANTES",
                  style: "tableSubTitulo",
                  colSpan: 2,
                  alignment: "center",
                },
                {},
                {
                  text: maxEstudiantes,
                  style: "tableTexto",
                  colSpan: 4,
                  alignment: "center",
                },
                {},
                {},
                {},
                {
                  text: "PROMEDIO GRADO",
                  style: "tableSubTitulo",
                  colSpan: 1,
                  alignment: "center",
                },
                {
                  text: promedioGrupal,
                  style: "tableTexto",
                  colSpan: 1,
                  alignment: "center",
                },
              ],

              [
                {
                  text: "",
                  style: "tableTexto",
                  colSpan: 9,
                  border: [false, false, false, false],
                  margin: [0, 10, 0, 0],
                },
              ],
            ],
          },
        },
        {
          pageBreak: "after",
          table: {
            widths: [
              100, 30, ...Array(numDynamicColumns).fill(dynamicColumnWidth)
            ],
            body: [
              [
                { text: "Alumno", style: "tableTitulo", alignment: "center" },
                { text: "Global", style: "tableTitulo", alignment: "center" },
                ...Object.keys(liMat).map((key) => ({ text: liMat[key], style: "tableTitulo", alignment: "center" }))
              ],
              ...ptMax.map((datAlum) => (
                [
                  { text: ptMat[datAlum[0]]['nombre'], style: "tableTexto2", alignment: "center" },
                  { text: datAlum[1].toFixed(2), style: "tableTexto2", alignment: "center" },
                  ...Object.keys(liMat).map((nomMat) => (
                    { text: ptMat[datAlum[0]][liMat[nomMat]], style: "tableTexto2", alignment: "center" }
                  ))
                ]
              ))
            ],
          },
        },
      ];

      docDefinition.content.push(...pageContent);

      const pdfDoc = pdfMake.createPdf(docDefinition);
      $('#cortina-de-espera').attr('style', 'overflow-y: auto; display:none;');
      pdfDoc.open();

    });

  })();

});
