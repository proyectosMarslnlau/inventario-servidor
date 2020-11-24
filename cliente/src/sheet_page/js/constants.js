const IP_SERVER = 'http://localhost:3000';
//
//DIRECCIONES LOCALES
const direccionInscription = './inscription.html';
const direccionLogin = '../page/login.html'
//
const urlStart=`../`;
//URL de peticion de Login
const urlLogin =
  `${IP_SERVER}/inventario-servidor/servidor/petition/admin/login/petitionLoginUser.php`;
//URL de envio de informacion de DATOS
const urlInformacion = `${IP_SERVER}/inventario-servidor/servidor/petition/admin/inscription/petitionUpdateDate.php`;
//URL peticion de datos de usuario
const urlPeticionLista = `${IP_SERVER}/inventario-servidor/servidor/petition/admin/list/petitionListObject.php`;
//URL peticion de vista de OBJETO
const urlViewObjeto = `${IP_SERVER}/inventario-servidor/servidor/petition/admin/list/petitionViewObject.php`;
//URL peticion lista de CODIGOS
const urlListaCodigos = `${IP_SERVER}/inventario-servidor/servidor/petition/admin/list/petitionCodeSelect.php`;
//URL ARRAY DE direcciones de REPORTES
const urlArrayReportesAll = [
  { urlmodell : `${IP_SERVER}/inventario-servidor/servidor/petition/admin/reports/modellOneAll.php`, number : 1},
  { urlmodell : `${IP_SERVER}/inventario-servidor/servidor/petition/admin/reports/modellTwoAll.php`, number : 2},
  { urlmodell : `${IP_SERVER}/inventario-servidor/servidor/petition/admin/reports/modellThreeAll.php`, number : 3}
];
const urlArrayReportCode = [
  { urlmodell : `${IP_SERVER}/inventario-servidor/servidor/petition/admin/reports/modellOneCode.php`, number : 1},
  { urlmodell : `${IP_SERVER}/inventario-servidor/servidor/petition/admin/reports/modellTwoCode.php`, number : 2},
  { urlmodell : `${IP_SERVER}/inventario-servidor/servidor/petition/admin/reports/modellThreeCode.php`, number : 3}
]
//url DIRECCIONES DE REPORTS PDF 
const urlPdfModellOneUnique = `${IP_SERVER}/inventario-servidor/servidor/public/documents/modellOne.pdf`;
const urlPdfModellTwoUnique = `${IP_SERVER}/inventario-servidor/servidor/public/documents/modelltwo.pdf`;
const urlPdfModellThreeUnique = `${IP_SERVER}/inventario-servidor/servidor/public/documents/modellThree.pdf`;
//url Borrar Objeto de LISTA
const urlDeleteObject = `${IP_SERVER}/inventario-servidor/servidor/petition/admin/list/petitionDeleteObject.php`;
//Url Modificar objeto del Objeto
const urlModifyObject = `${IP_SERVER}/inventario-servidor/servidor/petition/admin/list/petitionModifyObject.php`;