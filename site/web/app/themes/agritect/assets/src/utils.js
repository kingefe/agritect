
const db = window.firebase.firestore()

export const numberWithCommas = (x) => {
  if (x > 1.0 && typeof(Number(x)) == 'number')
    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  else
    return x
}

export const addCommasToNumber =  (x) => {
  if(typeof(Number(x.replace(",", ""))) == 'number'){

    let commaCount = x.split(",").length - 1

    for(let i = 0; i <= commaCount; i++){
      x = x.replace(",","")
    }

    return x.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

  }else{
    return x
  }
}

export const turnStringWithCommasToNumber = (x) => {
  if (x){
    console.log("x is: ", x)
    if(x.toString().includes(",")){
      let commaCount = x.split(",").length - 1
      for(let i = 0; i <= commaCount; i++){
        x = x.replace(",","")
      }
    }
    return parseInt(x)
  }
}

export const titleCase = (str) => {
  let splitStr = str.toLowerCase().split(' ');
  for (let i = 0; i < splitStr.length; i++) {
      splitStr[i] = splitStr[i].charAt(0).toUpperCase() + splitStr[i].substring(1);     
  }
  return splitStr.join(' '); 
}



export const deleteProjectFromFireStore = async (wpid, projectId) => {
  const collection = db.collection(`users/${wpid}/projects`)
  const doc =  collection.doc(projectId)
  doc.delete()
}