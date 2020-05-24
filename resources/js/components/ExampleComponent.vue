<template>
  <div>
    <header class="blog-header pb-3">
      <div class="navbar navbar-dark bg-dark box-shadow">
        <div class="container d-flex justify-content-between">
          <a href="#" class="navbar-brand d-flex align-items-center mx-auto">
            <strong>STI</strong>
          </a>
        </div>
      </div>
    </header>
    <div class="container">
      <div class="py-5 text-center">
        <button @click="InsertarData()" type="button" class="btn btn-primary mr-3">Importar</button>
        <button @click="BorrarData()" type="button" class="btn btn-danger">Borrar</button>
      </div>
      <div class="row" :class="[loading==true? 'd-none' : '']">
        <div class="col-md-12">
          <div class="table-responsive" :class="[ this.oCliente.length==0 ?'d-none' : '']">
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">#</th>
                  <th scope="col">Nombres</th>
                  <th scope="col">Apellidos</th>
                  <th scope="col">Telefono</th>
                  <th scope="col">Saldo</th>
                </tr>
              </thead>
              <tbody>
                <tr v-for="o in oCliente" :key="o.id">
                  <td>{{o.id}}</td>
                  <td>{{o.nombres}}</td>
                  <td>{{o.apellidos}}</td>
                  <td>{{o.telefono}}</td>
                  <td class="number">{{o.saldo}}</td>
                </tr>
              </tbody>
            </table>
          </div>

          <div
            class="alert alert-danger text-center"
            :class="[ this.oCliente.length==0 ?'' : 'd-none']"
            role="alert"
          >No se encontro datos en la tabla clientes.</div>
        </div>
      </div>
      <div class="mx-auto" :class="[loading==false? 'd-none' : 'text-center'] ">
        <div class="lds-roller">
          <div></div>
          <div></div>
          <div></div>
          <div></div>
          <div></div>
          <div></div>
          <div></div>
          <div></div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["ruta"],
  data() {
    return {
      loading: false,
      oCliente: {
        id: "",
        nombres: "",
        apellidos: "",
        telefono: "",
        saldo: ""
      }
    };
  },
  methods: {
    listarData() {
      let me = this;
      var url = this.ruta + "/getclientes";
      me.loading = true;
      //   console.log(url);
      axios
        .get(url)
        .then(function(response) {
          me.loading = false;

          var respuesta = response.data;
          me.oCliente = respuesta.clientes;
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    InsertarData() {
      let me = this;
      var url = this.ruta + "/putclientes";
      me.loading = true;
      axios
        .get(url)
        .then(function(response) {
          me.loading = false;
          me.listarData();
        })
        .catch(function(error) {
          console.log(error);
        });
    },
    BorrarData() {
      let me = this;
      var url = this.ruta + "/delclientes";
      me.loading = true;
      console.log(url);
      axios
        .get(url)
        .then(function(response) {
          me.loading = false;
          me.listarData();
        })
        .catch(function(error) {
          console.log(error);
        });
    }
  },
  mounted() {
    this.listarData();
  }
};
</script>
<style>
.lds-roller {
  display: inline-block;
  position: relative;
  width: 64px;
  height: 64px;
}
.lds-roller div {
  animation: lds-roller 1.2s cubic-bezier(0.5, 0, 0.5, 1) infinite;
  transform-origin: 32px 32px;
}
.lds-roller div:after {
  content: " ";
  display: block;
  position: absolute;
  width: 6px;
  height: 6px;
  border-radius: 50%;
  background: #1266f1;
  margin: -3px 0 0 -3px;
}
.lds-roller div:nth-child(1) {
  animation-delay: -0.036s;
}
.lds-roller div:nth-child(1):after {
  top: 50px;
  left: 50px;
}
.lds-roller div:nth-child(2) {
  animation-delay: -0.072s;
}
.lds-roller div:nth-child(2):after {
  top: 54px;
  left: 45px;
}
.lds-roller div:nth-child(3) {
  animation-delay: -0.108s;
}
.lds-roller div:nth-child(3):after {
  top: 57px;
  left: 39px;
}
.lds-roller div:nth-child(4) {
  animation-delay: -0.144s;
}
.lds-roller div:nth-child(4):after {
  top: 58px;
  left: 32px;
}
.lds-roller div:nth-child(5) {
  animation-delay: -0.18s;
}
.lds-roller div:nth-child(5):after {
  top: 57px;
  left: 25px;
}
.lds-roller div:nth-child(6) {
  animation-delay: -0.216s;
}
.lds-roller div:nth-child(6):after {
  top: 54px;
  left: 19px;
}
.lds-roller div:nth-child(7) {
  animation-delay: -0.252s;
}
.lds-roller div:nth-child(7):after {
  top: 50px;
  left: 14px;
}
.lds-roller div:nth-child(8) {
  animation-delay: -0.288s;
}
.lds-roller div:nth-child(8):after {
  top: 45px;
  left: 10px;
}
@keyframes lds-roller {
  0% {
    transform: rotate(0deg);
  }
  100% {
    transform: rotate(360deg);
  }
}
</style>
