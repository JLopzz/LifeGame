var el = document.getElementsByName('tds')
el.forEach(ele => {
  ele.onclick = e => {
    if(e.target.className == 'true') e.target.className='false'
    else e.target.className='true'
    getNeigh(ele.id, ele.className)
    getAlive()
  }
});

//obteniendo elementos se ocupa en getNeigh()
var element = (id,state) =>{
  let elem = document.getElementById(id)
  if(elem != null){
    state=='true'? elem.attributes.neigh.value++ : elem.attributes.neigh.value--
  }
}

//obteniendo vecinos para bucle se ocupa en getNeigh()
var nElement = (id) =>{
  let elem = document.getElementById(id)
  if(elem != null){
    return elem.className == 'true'? true : false
  }
}

// obtencion de vecinos
function getNeigh(id , state, bucle = false){
  let pX = Number(id.match(/^\d+/g))
  let pY = Number(id.match(/\d+$/g))
  let Mx = pX + 1
  let My = pY + 1
  let mx = pX - 1
  let my = pY - 1
  let res = 0
  for(let i = 0; i < 8; i++){
    switch (i) {
      case 0://(x-1 , y-1)
        !bucle?element(mx+'-'+my,state):nElement(mx+'-'+my)? res++:0
        break;
      case 1://(x-1 , y)
        !bucle?element(mx+'-'+pY,state):nElement(mx+'-'+pY)? res++:0
        break;
      case 2://(x-1 , y+1)
        !bucle?element(mx+'-'+My,state):nElement(mx+'-'+My)? res++:0
        break;
      case 3://(x , y-1)
        !bucle?element(pX+'-'+my,state):nElement(pX+'-'+my)? res++:0
        break;
      case 4://(x , y+1)
        !bucle?element(pX+'-'+My,state):nElement(pX+'-'+My)? res++:0
        break;
      case 5://(x+1 , y-1)
        !bucle?element(Mx+'-'+my,state):nElement(Mx+'-'+my)? res++:0
        break;
      case 6://(x+1 , y)
        !bucle?element(Mx+'-'+pY,state):nElement(Mx+'-'+pY)? res++:0
        break;
      case 7://(x+1 , y+1)
        !bucle?element(Mx+'-'+My,state):nElement(Mx+'-'+My)? res++:0
        break;
      default: break;
    }
  }
  return res
}

function sleep(ms) {
  return new Promise(resolve => setTimeout(resolve, ms));
}

var colorElement = (id,state) =>{
  let elem = document.getElementById(id)
  elem.className=state
}

var neighElement = (id,state) =>{
  let elem = document.getElementById(id)
  elem.attributes.neigh.value = getNeigh(id,state,true)
}

async function each(){
  var iter = document.getElementById('itera').value
  //bucle
  for (let a = 0; a < iter; a++) {
    let state = []
    el.forEach(ele => {
      state.push({
        id: ele.id,
        state: ele.className,
        neigh: ele.attributes.neigh.value
      })
    })
    //reglas del juego
    for(let i in state){
      if(state[i].state == 'false' && Number(state[i].neigh) == 3 )
        state[i].state = 'true';
      else if(state[i].state == 'true' && (Number(state[i].neigh) < 2 || Number(state[i].neigh) > 3))
        state[i].state = 'false';
    }
    for(let i in state) colorElement(state[i].id,state[i].state)
    for(let i in state) neighElement(state[i].id,state[i].state)
    getAlive()
    getGen()
    iter < 10? await sleep(200):
      iter < 100? await sleep(100):
        iter < 200? await sleep(50): await sleep(20)
    }
}

function getAlive(){
  let count = 0
  //variables de prueba para estado inicial
  console.clear()
  let n = {
    n1:{
      true:[],
      false:[]
    },
    n2:{
      true:[],
      false:[]
    },
    n3:{
      true:[],
      false:[]
    },
    n4:{
      true:[],
      false:[]
    },
  }
  el.forEach(a=>{
    if(a.className=='true') count++;
    //if de prueba para estado inicial
    if(a.attributes.neigh.value==1) n.n1[a.className].push(a)
    else if(a.attributes.neigh.value==2) n.n2[a.className].push(a)
    else if(a.attributes.neigh.value==3) n.n3[a.className].push(a)
    else if(a.attributes.neigh.value==4) n.n4[a.className].push(a)
  })
  //console.log(n)
  let m = []
  el.forEach(a=>{
    if(a.attributes.neigh.value > 0){
      let item = {
        neigh: a.attributes.neigh.value,
        state: a.className,
        positionX: Number(a.id.match(/^\d+/g)),
        positionY: Number(a.id.match(/\d+$/g))
      }
      m.push(item)
    }
  })
  m.forEach(a => {
    // console.log(a)
  })
  console.log(m)
  //fin de script agregado para pruebas
  document.getElementById('alive').innerText='Celulas Vivas: '+count
  document.getElementById('aliveCel').innerText='Celulas Vivas: '+count
}

function getGen(){
  let num = Number(document.getElementById('gen').innerText.match(/\d+$/g))
  num++
  document.getElementById('gen').innerText='Generacion: '+num
  document.getElementById('genCel').innerText='Generacion: '+num
}

document.getElementById('iteraCel').oninput = e =>{
  document.getElementById('itera').value = e.target.value
}