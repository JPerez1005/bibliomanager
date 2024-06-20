<template>
    <header>
      <div>Seccion Animada</div>
      <div><a href="">Julián</a></div>
    </header>
    <section class="first">
      <div class="outer">
        <div class="inner">
          <div class="bg one">
            <h2 class="section-heading">
                <div class="rutas">
                    <router-link :to="{name:'tabla_usuarios'}">Ver</router-link>
                    <router-link :to="{name:'usuarios'}">Usuarios</router-link>
                </div>
                <h1 class="font-bold">Usuarios</h1>
            </h2>
          </div>
        </div>
      </div>
    </section>
    <section class="second">
      <div class="outer">
        <div class="inner">
          <div class="bg">
            <h2 class="section-heading">
                <div class="rutas">
                    <router-link :to="{name:'autores'}">Registrar</router-link>
                    <router-link :to="{name:'tabla_autores'}">Ver</router-link>
                </div>
                <h1 class="font-bold">Autores</h1>
            </h2>
          </div>
        </div>
      </div>
    </section>
    <section class="third">
      <div class="outer">
        <div class="inner">
          <div class="bg">
            <h2 class="section-heading">
                <div class="rutas">
                    <router-link :to="{name:'libros'}">Registrar</router-link>
                    <router-link :to="{name:'tabla_libros'}">Ver</router-link>
                </div>
                <h1 class="font-bold">Libros</h1>
            </h2>
          </div>
        </div>
      </div>
    </section>
    <section class="fourth">
      <div class="outer">
        <div class="inner">
          <div class="bg">
              <h2 class="section-heading">
                <div class="rutas">
                    <router-link :to="{name:'prestamos'}">Registrar</router-link>
                    <router-link :to="{name:'tabla_prestamos'}">Ver</router-link>
                </div>
                <h1 class="font-bold">Prestamos</h1>
            </h2>
          </div>
        </div>
      </div>
    </section>
    <!-- <section class="fifth">
      <div class="outer">
        <div class="inner">
          <div class="bg">
            <h2 class="section-heading">Keep scrolling</h2>
          </div>
        </div>
      </div>
    </section> -->
  </template>
  
<script>
  import { gsap } from "gsap";
  import Observer from "gsap/Observer";
  
  gsap.registerPlugin(Observer);
  
  export default {
    mounted() {
      this.initGsapAnimations();
    },
    methods: {
      initGsapAnimations() {
        let sections = document.querySelectorAll("section"),
          images = document.querySelectorAll(".bg"),
          headings = gsap.utils.toArray(".section-heading"),
          outerWrappers = gsap.utils.toArray(".outer"),
          innerWrappers = gsap.utils.toArray(".inner"),
          currentIndex = -1,
          wrap = gsap.utils.wrap(0, sections.length),
          animating;
  
        gsap.set(outerWrappers, { yPercent: 100 });
        gsap.set(innerWrappers, { yPercent: -100 });
  
        const gotoSection = (index, direction) => {
          index = wrap(index); // make sure it's valid
          animating = true;
          let fromTop = direction === -1,
            dFactor = fromTop ? -1 : 1,
            tl = gsap.timeline({
              defaults: { duration: 1.25, ease: "power1.inOut" },
              onComplete: () => (animating = false),
            });
          if (currentIndex >= 0) {
            // The first time this function runs, current is -1
            gsap.set(sections[currentIndex], { zIndex: 0 });
            tl.to(images[currentIndex], { yPercent: -15 * dFactor }).set(sections[currentIndex], { autoAlpha: 0 });
          }
          gsap.set(sections[index], { autoAlpha: 1, zIndex: 1 });
          tl.fromTo(
            [outerWrappers[index], innerWrappers[index]],
            {
              yPercent: (i) => (i ? -100 * dFactor : 100 * dFactor),
            },
            {
              yPercent: 0,
            },
            0
          )
            .fromTo(images[index], { yPercent: 15 * dFactor }, { yPercent: 0 }, 0)
            .fromTo(
              headings[index],
              {
                autoAlpha: 0,
                yPercent: 150 * dFactor,
              },
              {
                autoAlpha: 1,
                yPercent: 0,
                duration: 1,
                ease: "power2",
                stagger: {
                  each: 0.02,
                  from: "random",
                },
              },
              0.2
            );
  
          currentIndex = index;
        };
  
        Observer.create({
          type: "wheel,touch,pointer",
          wheelSpeed: -1,
          onDown: () => !animating && gotoSection(currentIndex - 1, -1),
          onUp: () => !animating && gotoSection(currentIndex + 1, 1),
          tolerance: 10,
          preventDefault: true,
        });
  
        gotoSection(0, 1);
      },
    },
  };
</script>
  
<style>
  @import url("https://fonts.googleapis.com/css2?family=Bebas+Neue&display=swap");
  @import url("https://fonts.googleapis.com/css2?family=Cormorant+Garamond&display=swap");
  
  * {
    box-sizing: border-box;
    user-select: none;
  }
  a {
    color: #fff;
    text-decoration: none;
  }
  body {
    margin: 0;
    padding: 0;
    height: 100vh;
    color: white;
    background: black;
    font-family: "Cormorant Garamond", serif;
    text-transform: uppercase;
    position: absolute;
  }

  h2 {
    font-size: clamp(1rem, 5vw, 5rem);
    font-weight: 400;
    text-align: center;
    letter-spacing: 0.5em;
    margin-right: -0.5em;
    color: #ccc;
    width: 90vw;
    max-width: 1200px;
  }
  
  header {
    left: 0;
    position: fixed;
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 0 5%;
    width: 100%;
    z-index: 2;
    height: 7em;
    font-family: "Bebas Neue", sans-serif;
    font-size: clamp(0.66rem, 2vw, 1rem);
    letter-spacing: 0.5em;
  }
  section {
    height: 100%;
    width: 100%;
    top: 0;
    left: 0;
    position: fixed;
  }
  section .outer,
  section .inner {
    width: 100%;
    height: 100%;
    overflow-y: hidden;
  }
  section .bg {
    display: flex;
    align-items: center;
    justify-content: center;
    position: relative;
    height: 100%;
    width: 100%;
    top: 0;
    left: 0;
    background-size: cover;
    background-position: center;
  }
  section .bg h2 {
    z-index: 2;
  }
  section .bg .clip-text {
    overflow: hidden;
  }
  .first .bg {
    background-image: linear-gradient(180deg, rgba(0, 0, 0, 0.6) 0%, rgba(0, 0, 0, 0.3) 100%), url(https://images.unsplash.com/photo-1617478755490-e21232a5eeaf?crop=entropy&cs=srgb&fm=jpg&ixid=MnwxNDU4OXwwfDF8cmFuZG9tfHx8fHx8fHx8MTYxNzU1NjM5NA&ixlib=rb-1.2.1&q=75&w=1920);
  }
  .second .bg {
    background-image: linear-gradient(180deg, rgba(0, 0, 0, 0.6) 0%, rgba(0, 0, 0, 0.3) 100%), url("https://images.unsplash.com/photo-1617128734662-66da6c1d3505?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=MnwxNDU4OXwwfDF8cmFuZG9tfHx8fHx8fHx8MTYxNzc3NTM3MA&ixlib=rb-1.2.1&q=75&w=1920");
  }
  .third .bg {
    background-image: linear-gradient(180deg, rgba(0, 0, 0, 0.6) 0%, rgba(0, 0, 0, 0.3) 100%), url(https://images.unsplash.com/photo-1617438817509-70e91ad264a5?crop=entropy&cs=srgb&fm=jpg&ixid=MnwxNDU4OXwwfDF8cmFuZG9tfHx8fHx8fHx8MTYxNzU2MDk4Mg&ixlib=rb-1.2.1&q=75&w=1920);
  }
  .fourth .bg {
    background-image: linear-gradient(180deg, rgba(0, 0, 0, 0.6) 0%, rgba(0, 0, 0, 0.3) 100%), url(https://images.unsplash.com/photo-1617412327653-c29093585207?crop=entropy&cs=srgb&fm=jpg&ixid=MnwxNDU4OXwwfDF8cmFuZG9tfHx8fHx8fHx8MTYxNzU2MDgzMQ&ixlib=rb-1.2.1&q=75&w=1920);
  }
  .fifth .bg {
    background-image: linear-gradient(180deg, rgba(0, 0, 0, 0.6) 0%, rgba(0, 0, 0, 0.3) 100%), url("https://images.unsplash.com/photo-1617141636403-f511e2d5dc17?crop=entropy&cs=srgb&fm=jpg&ixid=MnwxNDU4OXwwfDF8cmFuZG9tfHx8fHx8fHx8MTYxODAzMjc4Mw&ixlib=rb-1.2.1&q=75w=1920");
    background-position: 50% 45%;
  }
  h2 * {
    will-change: transform;
  }

  .section-heading{
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    bottom: 10%;
  }

  .rutas{
    width: 80%;
    display: flex;
    flex-direction: row;
    justify-content: space-evenly;
    margin-top: 5%;
    z-index: 3;
    margin-bottom: 10%;
  }
</style>
  