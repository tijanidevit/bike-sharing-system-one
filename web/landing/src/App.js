import logo from './logo.svg';
import './App.css';

function App() {
  return (

    <div data-spy="scroll" data-target="#main_menu" data-offset="70">

      <div className="preloader">
        <div className="loader-wrapper">
          <div className="loader"></div>
        </div>
      </div>

      <div className="themes-colors">
        <h3>Theme customization</h3>
        <h6>Solid</h6>
        <span><i className="fas fa-cog"></i></span>
        <ul className="solid">
          <li>
            <a href="javascript:void(0)" data-style="color-1"></a>
          </li>
          <li>
            <a href="javascript:void(0)" data-style="color-2"></a>
          </li>
          <li>
            <a href="javascript:void(0)" data-style="color-3"></a>
          </li>
          <li>
            <a href="javascript:void(0)" data-style="color-4"></a>
          </li>
          <li>
            <a href="javascript:void(0)" data-style="color-5"></a>
          </li>
          <li>
            <a href="javascript:void(0)" data-style="color-6"></a>
          </li>
          <li>
            <a href="javascript:void(0)" data-style="color-7"></a>
          </li>
          <li>
            <a href="javascript:void(0)" data-style="color-8"></a>
          </li>
          <li>
            <a href="javascript:void(0)" data-style="color-9"></a>
          </li>
          <li>
            <a href="javascript:void(0)" data-style="color-10"></a>
          </li>
        </ul>
        <h6>Gradient</h6>
        <ul className="gradient">
          <li>
            <a href="javascript:void(0)" data-style="color-11"></a>
          </li>
          <li>
            <a href="javascript:void(0)" data-style="color-12"></a>
          </li>
          <li>
            <a href="javascript:void(0)" data-style="color-13"></a>
          </li>
          <li>
            <a href="javascript:void(0)" data-style="color-14"></a>
          </li>
          <li>
            <a href="javascript:void(0)" data-style="color-15"></a>
          </li>
          <li>
            <a href="javascript:void(0)" data-style="color-16"></a>
          </li>
          <li>
            <a href="javascript:void(0)" data-style="color-17"></a>
          </li>
          <li>
            <a href="javascript:void(0)" data-style="color-18"></a>
          </li>
          <li>
            <a href="javascript:void(0)" data-style="color-19"></a>
          </li>
          <li>
            <a href="javascript:void(0)" data-style="color-20"></a>
          </li>
        </ul>
      </div>

      <header className="foxapp-header">
        <nav className="navbar navbar-expand-lg navbar-light" id="foxapp_menu">
          <div className="container">
            <a className="navbar-brand" href="./">
              <img src="assets/img/logo.png" className="img-fluid" alt="" style={{ width: '100px' }} />
            </a>
            <button className="navbar-toggler" type="button" data-toggle="collapse" data-target="#main_menu"
              aria-controls="main_menu" aria-expanded="false" aria-label="Toggle navigation">
              <span className="navbar-toggler-icon"></span>
            </button>
            <div className="collapse navbar-collapse" id="main_menu">
              <ul className="navbar-nav ml-auto">
                <li className="nav-item">
                  <a className="nav-link anchor active" href="#slide">Home
                  </a>
                </li>
                <li className="nav-item">
                  <a className="nav-link anchor" href="#about">About</a>
                </li>
                <li className="nav-item">
                  <a className="nav-link anchor" href="#main_features">Features</a>
                </li>
                <li className="nav-item">
                  <a className="nav-link anchor" href="#screenshots">Screenshots</a>
                </li>
                <li className="nav-item">
                  <a className="nav-link anchor" href="#team">Team</a>
                </li>
                <li className="nav-item">
                  <a className="nav-link anchor" href="#git_in_touch">Contact</a>
                </li>
              </ul>
            </div>
          </div>
        </nav>
      </header>

      <section id="slide" className="slide background-withcolor">
        <div className="content-bottom">
          <div className="container">
            <div className="row align-items-center">
              <div className="col-md-6" data-aos="fade-right">
                <p className="mb-0">With us you will</p>
                <h2>succeed</h2>
                <p>We take you to your dream place at anytime you want. Start booking your bikes now and start
                  movin close to sucess.
                </p>
                <a href="#" className="btn btn-primary btn-white shadow btn-theme"><span>Read More</span></a>
              </div>
              <div className="col-md-6" data-aos="fade-left" data-aos-delay="200">
                <img src="assets/img/sc/home.jpg" style={{ height: '700px' }} className="img-fluid d-block mx-auto"
                  alt="" />
              </div>
            </div>
          </div>
        </div>
      </section>

      <section id="boxes" className="boxes padding-100">
        <div className="container">
          <div className="row">
            <div className="col-md-4 col-12">
              <div className="box" data-aos="fade-up">
                <div className="icon">
                  <span className="lnr lnr lnr-magic-wand"></span>
                </div>
                <div className="space-20"></div>
                <h4>Creative Design</h4>
                <div className="space-15"></div>
                <p>Proactively syndicate open-source e-markets after low-risk high-yield synergy.</p>
              </div>
            </div>
            <div className="col-md-4 col-12">
              <div className="box" data-aos="fade-up" data-aos-delay="200">
                <div className="icon">
                  <span className="lnr lnr-rocket"></span>
                </div>
                <div className="space-20"></div>
                <h4>Free support</h4>
                <div className="space-15"></div>
                <p>Proactively syndicate open-source e-markets after low-risk high-yield synergy.</p>
              </div>
            </div>
            <div className="col-md-4 col-12">
              <div className="box" data-aos="fade-up" data-aos-delay="400">
                <div className="icon">
                  <span className="lnr lnr-diamond"></span>
                </div>
                <div className="space-20"></div>
                <h4>Exclusive Bikes</h4>
                <div className="space-15"></div>
                <p>Proactively syndicate open-source e-markets after low-risk high-yield synergy.</p>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section id="about" className="why-us padding-100 background-fullwidth background-fixed "
        style={{ backgroundImage: require(assets / img / gray - bg.jpg) }}>
        <div className="container">
          <div className="row align-items-center">
            <div className="col-md-6 text-center" data-aos="fade-right">
              <img src="assets/img/sc/lp.jpg" style={{ height: '600px' }} className="img-fluid" alt="" />
            </div>
            <div className="col-md-6" data-aos="fade-zoom-in" data-aos-delay="200">
              <h3>Make Business Easy With Us</h3>
              <p>Lorem ipsum madolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor coli
                incidit
                labore
                lorem
              </p>
              <div className="space-50"></div>
              <div className="row">
                <div className="col-lg-6 col-md-6 col-sm-6 col-12" data-aos="zoom-in" data-aos-delay="400">
                  <div className="why-us-icon">
                    <span className="lnr lnr-rocket"></span>
                    <p>Intrinsically aggregate cutting-edge internal or "organic" sources through pandemic.
                    </p>
                  </div>
                  <div className="space-25"></div>
                </div>
                <div className="col-lg-6 col-md-6 col-sm-6 col-12" data-aos="zoom-in" data-aos-delay="600">
                  <div className="why-us-icon">
                    <span className="lnr lnr-rocket"></span>
                    <p>It doesn't matter if you are in an office or on an airplane. You will never lose a
                      second.
                    </p>
                  </div>
                </div>
                <div className="space-25"></div>
              </div>
              <div className="row">
                <div className="col-lg-6 col-md-6 col-sm-6 col-12" data-aos="zoom-in" data-aos-delay="800">
                  <div className="why-us-icon">
                    <span className="lnr lnr-rocket"></span>
                    <p>It doesn't matter if you are in an office or on an airplane. You will never lose a
                      second.
                    </p>
                  </div>
                  <div className="space-25"></div>
                </div>
                <div className="col-lg-6 col-md-6 col-sm-6 col-12" data-aos="zoom-in" data-aos-delay="1000">
                  <div className="why-us-icon">
                    <span className="lnr lnr-rocket"></span>
                    <p>Intrinsically aggregate cutting-edge internal or "organic" sources through pandemic.
                    </p>
                  </div>
                  <div className="space-25"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section id="main_features" className="main-features padding-100">
        <div className="container">
          <div className="row">
            <div className="text-center col-12 section-title" data-aos="fade-zoom-in">
              <h3>Main
                <span>Features</span>
              </h3>
              <div className="space-25"></div>
              <p>Lorem ipsum madolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor coli
                incidit
                labore
                lorem ipsum amet madolor sit amet.</p>
              <div className="space-25"></div>
            </div>
          </div>
          <div className="row align-items-center">
            <div className="col-lg-3 text-lg-right left-side">
              <div className="one-feature one" data-aos="fade-right" data-aos-delay="1000">
                <h5>Lorem ipsum</h5>
                <span className="lnr lnr-rocket"></span>
                <p>Our system is a comprehensive system of applied creativity.</p>
              </div>
              <div className="one-feature" data-aos="fade-right" data-aos-delay="1400">
                <h5>Lorem ipsum</h5>
                <span className="lnr lnr-cog"></span>
                <p>For more than 5 years, we’ve been passionate about achieving better.</p>
              </div>
              <div className="one-feature" data-aos="fade-right" data-aos-delay="1800">
                <h5>Lorem ipsum</h5>
                <span className="lnr lnr-cloud"></span>
                <p>Our system is a comprehensive system of applied creativity.</p>
              </div>
            </div>
            <div className="col-lg-6 text-center">
              <div className="features-circle">
                <div className="circle-svg" data-aos="zoom-in" data-aos-delay="400">
                  <svg version="1.1" id="features_circle" x="0px" y="0px" width="543px"
                    height="542.953px" viewBox="0 0 543 542.953" enable-background="new 0 0 543 542.953"
                  >
                    <g>
                      <circle fill="none" stroke="#" stroke-width="3" stroke-miterlimit="10"
                        stroke-dasharray="11.9474,11.9474" cx="271.5" cy="271.516" r="270" />
                      <animateTransform attributeName="transform" type="rotate" from="0" to="360"
                        dur="50s" repeatCount="indefinite"></animateTransform>
                    </g>
                  </svg>
                </div>
                <img data-aos="fade-up" style={{ height: '680px' }} data-aos-delay="200"
                  src="assets/img/sc/allbikes.jpg" className="img-fluid" alt="" />
              </div>
            </div>
            <div className="col-lg-3 right-side">
              <div className="one-feature" data-aos="fade-left" data-aos-delay="1000">
                <h5>Lorem ipsum</h5>
                <span className="lnr lnr-construction"></span>
                <p>Our system is a comprehensive system of applied creativity.</p>
              </div>
              <div className="one-feature" data-aos="fade-left" data-aos-delay="1400">
                <h5>Lorem ipsum</h5>
                <span className="lnr lnr-gift"></span>
                <p>For more than 5 years, we’ve been passionate about achieving better.</p>
              </div>
              <div className="one-feature" data-aos="fade-left" data-aos-delay="1800">
                <h5>Lorem ipsum</h5>
                <span className="lnr lnr-database"></span>
                <p>For more than 5 years, we’ve been passionate about achieving better.</p>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section id="other_features" className="other-features padding-100 background-withcolor">
        <div className="container-fluid">
          <div className="row">
            <div className="text-center col-12 section-title" data-aos="fade-zoom-in">
              <h3>Other
                <span className="white"> Awesome </span> Features
              </h3>
              <div className="space-25"></div>
              <p>Lorem ipsum madolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor coli
                incidit
                labore
                lorem ipsum amet madolor sit amet.</p>
              <div className="space-50"></div>
            </div>
          </div>
          <div className="row align-items-center">
            <div className="col-12">
              <div className="other-features-slider" data-aos="fade-up">

                <div className="item text-center">
                  <span className="lnr lnr-rocket"></span>
                  <h4>Creative Design</h4>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Et atque eos amet vel
                    voluptatibus
                    incidunt.
                  </p>
                </div>
                <div className="item text-center">
                  <span className="lnr lnr-cog"></span>
                  <h4>Easy Login</h4>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Et atque eos amet vel
                    voluptatibus
                    incidunt.
                  </p>
                </div>
                <div className="item text-center">
                  <span className="lnr lnr-cloud"></span>
                  <h4>Fast Install</h4>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Et atque eos amet vel
                    voluptatibus
                    incidunt.
                  </p>
                </div>
                <div className="item text-center">
                  <span className="lnr lnr-construction"></span>
                  <h4>Data Protect</h4>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Et atque eos amet vel
                    voluptatibus
                    incidunt.
                  </p>
                </div>
                <div className="item text-center">
                  <span className="lnr lnr-gift"></span>
                  <h4>High Resolution</h4>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Et atque eos amet vel
                    voluptatibus
                    incidunt.
                  </p>
                </div>
                <div className="item text-center">
                  <span className="lnr lnr-database"></span>
                  <h4>Clean Code</h4>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Et atque eos amet vel
                    voluptatibus
                    incidunt.
                  </p>
                </div>
                <div className="item text-center">
                  <span className="lnr lnr-gift"></span>
                  <h4>Quick Support</h4>
                  <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Et atque eos amet vel
                    voluptatibus
                    incidunt.
                  </p>
                </div>

              </div>
            </div>
          </div>
        </div>
      </section>

      <section id="watch_video" className="watch-video padding-100">
        <div className="container-fluid">
          <div className="row">
            <div className="text-center col-12 section-title" data-aos="fade-zoom-in">
              <h3>Watch
                <span> Video</span>
              </h3>
              <div className="space-25"></div>
              <p>Lorem ipsum madolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor coli
                incidit
                labore
                lorem ipsum amet madolor sit amet.</p>
              <div className="space-50"></div>
            </div>
            <div className="col-md-6 offset-md-3" data-aos="fade-up">
              <div className="video" style={{ backgroundImage: require('assets/img/people.jpg') }}>
                <img src="assets/img/mobile-4-4.png" className="img-fluid d-block mx-auto" alt="" />
                <a href="http://www.youtube.com/watch?v=XSGBVzeBUbk" data-lity>d</a>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section id="screenshots" className="screenshots padding-100 background-fullwidth background-fixed"
        style={{ backgroundImage: require(assets / img / gray - bg.jpg) }}>
        <div className="container-fluid">
          <div className="row">
            <div className="text-center col-12 section-title" data-aos="fade-zoom-in">
              <h3>Awesome
                <span> Screenshots</span>
              </h3>
              <div className="space-25"></div>
              <p>Lorem ipsum madolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor coli
                incidit
                labore
                lorem ipsum amet madolor sit amet.</p>
              <div className="space-50"></div>
            </div>
          </div>
          <div className="row align-items-center">
            <div className="col-12">
              <div className="screenshots-slider" data-aos="fade-up">


                <div className="item text-center">
                  <img src="assets/img/sc/lp.jpg" style={{ height: "600px" }} className="img-fluid d-block mx-auto"
                    alt="" />
                </div>
                <div className="item text-center">
                  <img src="assets/img/sc/signup.jpg" style={{ height: "600px" }} className="img-fluid d-block mx-auto"
                    alt="" />
                </div>
                <div className="item text-center">
                  <img src="assets/img/sc/login.jpg" style={{ height: "600px" }} className="img-fluid d-block mx-auto"
                    alt="" />
                </div>
                <div className="item text-center">
                  <img src="assets/img/sc/home.jpg" style={{ height: "600px" }} className="img-fluid d-block mx-auto"
                    alt="" />
                </div>
                <div className="item text-center">
                  <img src="assets/img/sc/allbikes.jpg" style={{ height: "600px" }}
                    className="img-fluid d-block mx-auto" alt="" />
                </div>
                <div className="item text-center">
                  <img src="assets/img/sc/bikedetails.jpg" style={{ height: "600px" }}
                    className="img-fluid d-block mx-auto" alt="" />
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>

      <section id="testimonial" className="clients-testimonial padding-100">
        <div className="container">
          <div className="row">
            <div className="text-center col-12 section-title" data-aos="fade-zoom-in">
              <h3>Clients
                <span> Testimonial</span>
              </h3>
              <div className="space-25"></div>
              <p>Lorem ipsum madolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor coli
                incidit
                labore
                lorem ipsum amet madolor sit amet.</p>
              <div className="space-50"></div>
            </div>
            <div className="col-12">
              <div className="testimonial-slider" data-aos="fade-up">
                <div className="item">
                  <div className="client-testimonial">
                    <p>
                      Completely build backend ROI whereas cross-media metrics. Collaboratively deploy
                      customer directed web-readiness via global testing procedures. Appropriately
                      reinvent distributed innovation.
                    </p>
                  </div>
                  <div className="client-info d-flex align-items-center">
                    <figure>
                      <img src="assets/img/client.jpg" className="img-fluid" alt="" />
                    </figure>
                    <div>
                      <h3>Mohamed Kamel</h3>
                      <h6>CEO - Company Name</h6>
                    </div>
                  </div>
                </div>
                <div className="item">
                  <div className="client-testimonial">
                    <p>
                      If you can design one thing you can design everything with Front. Just believe it.
                      Collaboratively repurpose performance based e-commerce without cost. It's beautiful
                      and the coding is done quickly and seamlessly.
                    </p>
                  </div>
                  <div className="client-info d-flex align-items-center">
                    <figure>
                      <img src="assets/img/client.jpg" className="img-fluid" alt="" />
                    </figure>
                    <div>
                      <h3>Mohamed Kamel</h3>
                      <h6>CEO - Company Name</h6>
                    </div>
                  </div>
                </div>
                <div className="item">
                  <div className="client-testimonial">
                    <p>
                      If you can design one thing you can design everything with Front. Just believe it.
                      Collaboratively repurpose performance based e-commerce without cost. It's beautiful
                      and the coding is done quickly and seamlessly.
                    </p>
                  </div>
                  <div className="client-info d-flex align-items-center">
                    <figure>
                      <img src="assets/img/client.jpg" className="img-fluid" alt="" />
                    </figure>
                    <div>
                      <h3>Mohamed Kamel</h3>
                      <h6>CEO - Company Name</h6>
                    </div>
                  </div>
                </div>
                <div className="item">
                  <div className="client-testimonial">
                    <p>
                      Completely build backend ROI whereas cross-media metrics. Collaboratively deploy
                      customer directed web-readiness via global testing procedures. Appropriately
                      reinvent distributed innovation.
                    </p>
                  </div>
                  <div className="client-info d-flex align-items-center">
                    <figure>
                      <img src="assets/img/client.jpg" className="img-fluid" alt="" />
                    </figure>
                    <div>
                      <h3>Mohamed Kamel</h3>
                      <h6>CEO - Company Name</h6>
                    </div>
                  </div>
                </div>
                <div className="item">
                  <div className="client-testimonial">
                    <p>
                      Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit fugit dignissimos
                      nihil deleniti sunt enim cupiditate quia
                      officia suscipit est saepe atque expedita, natus numquam animi inventore harum
                      esse
                      ut.
                    </p>
                  </div>
                  <div className="client-info d-flex align-items-center">
                    <figure>
                      <img src="assets/img/client.jpg" className="img-fluid" alt="" />
                    </figure>
                    <div>
                      <h3>Mohamed Kamel</h3>
                      <h6>CEO - Company Name</h6>
                    </div>
                  </div>
                </div>
                <div className="item">
                  <div className="client-testimonial">
                    <p>
                      Lorem ipsum dolor sit amet consectetur adipisicing elit. Odit fugit dignissimos
                      nihil deleniti sunt enim cupiditate quia
                      officia suscipit est saepe atque expedita, natus numquam animi inventore harum
                      esse
                      ut.
                    </p>
                  </div>
                  <div className="client-info d-flex align-items-center">
                    <figure>
                      <img src="assets/img/client.jpg" className="img-fluid" alt="" />
                    </figure>
                    <div>
                      <h3>Mohamed Kamel</h3>
                      <h6>CEO - Company Name</h6>
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
        </div>
      </section>
      <section id="download_app" className="download-app padding-100 pb-0 background-fullwidth background-fixed"
        style={{ backgroundImage: require(assets / img / gray - bg.jpg) }}>
        <div className="container">
          <div className="row align-items-center">
            <div className="col-lg-6 col-12" data-aos="fade-right">
              <h2>Download our free trial App</h2>
              <p>Lorem ipsum madolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor coli
                incidit
                labore
                lorem
              </p>
              <a href="#" className="btn btn-primary shadow btn-colord btn-theme" tabindex="0">
                <i className="fab fa-apple"></i>
                <span>Git it on <br />APP STORE</span> </a>
              <a href="#" className="btn btn-primary shadow  btn-colord btn-theme" tabindex="0">
                <i className="fab fa-google-play"></i>
                <span>Git it on
                  <br />GOOGLE PLAY</span>
              </a>
            </div>
            <div className="col-lg-6 col-12" data-aos="fade-left" data-aos-delay="400">
              <img src="assets/img/mobile-6.png" className="img-fluid d-block mx-auto" alt="" />
            </div>
          </div>
        </div>
      </section>

      <section id="git_in_touch" className="git-in-touch padding-100">
        <div className="container">
          <div className="row">
            <div className="text-center col-12 section-title" data-aos="fade-zoom-in">
              <h3>Git
                <span> in </span>touch
              </h3>
              <div className="space-25"></div>
              <p>Lorem ipsum madolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor coli
                incidit
                labore
                lorem ipsum amet madolor sit amet.</p>
              <div className="space-50"></div>
            </div>
          </div>
          <form data-aos="fade-up">
            <div className="row">
              <div className="col-md-4">
                <div className="form-group">
                  <input type="text" className="form-control" placeholder="Enter Your Name" />
                  <span className="focus-border"></span>
                </div>
              </div>
              <div className="col-md-4">
                <div className="form-group">
                  <input type="email" className="form-control" placeholder="Enter Your Email" />
                  <span className="focus-border"></span>
                </div>
              </div>
              <div className="col-md-4">
                <div className="form-group">
                  <input type="text" className="form-control" placeholder="Enter Your Subject" />
                  <span className="focus-border"></span>
                </div>
              </div>
              <div className="col-12">
                <div className="form-group">
                  <textarea className="form-control" rows="4" placeholder="Enter Your Message"></textarea>
                  <span className="focus-border"></span>
                </div>
              </div>
              <div className="col-12">
                <div className="space-25"></div>
                <button type="submit" className="btn btn-primary shadow btn-colord btn-theme"><span>Send
                  Message</span></button>
              </div>
            </div>
          </form>
          <div className="space-50"></div>
          <div className="row contact-info">
            <div className="col-md-4 col-12 text-center">
              <div className="info-box" data-aos="fade-right" data-aos-delay="400">
                <span className="lnr lnr-map-marker"></span>
                <h5>28 Green Tower, Street Name New York City, USA</h5>
              </div>
            </div>
            <div className="col-md-4 col-12 text-center">
              <div className="info-box" data-aos="fade-up" data-aos-delay="800">
                <span className="lnr lnr-phone"></span>
                <h5>+2 012 345 6789</h5>
                <h5>+2 02 345 6789</h5>
              </div>
            </div>
            <div className="col-md-4 col-12 text-center">
              <div className="info-box" data-aos="fade-left" data-aos-delay="1200">
                <span className="lnr lnr-envelope"></span>
                <a href="mailto:info@yourcompany.com">info@yourcompany.com</a>
                <a href="mailto:sales@yourcompany.com">sales@yourcompany.com</a>
              </div>
            </div>
          </div>
        </div>
      </section>

      <footer className="padding-100 pb-0">
        <div className="subscribe">
          <div className="container">
            <form className="subscribe-form row m-0 align-items-center">
              <div className="col-lg-9 col-md-8">
                <div className="form-group mb-0">
                  <input type="text" className="form-control" placeholder="Enter Your Email" />
                </div>
              </div>
              <div className="col-lg-3 col-md-4">
                <a href="#"
                  className="btn btn-primary shadow d-block btn-colord btn-theme"><span>subscribe</span></a>
              </div>
            </form>
          </div>
        </div>
        <div className="space-50"></div>
        <div className="footer-widgets">
          <div className="container">
            <div className="row">
              <div className="col-lg-3 col-md-6 col-12">
                <div className="widget">
                  <img src="assets/img/logo.png" className="img-fluid" alt="" />
                  <p>Sed pottitor lects nibh. Viamus magna justo, lacinia eget consectetur sed, convallis
                    at
                    tellus.
                    Curabitur aliquet quam id dui posuere blandit. Lorem ipsum dolor sit amet,
                    consectetur
                    adipiscing
                    elit.
                  </p>
                </div>
              </div>
              <div className="col-lg-3 col-md-6 col-12">
                <div className="widget">
                  <h6>Quick Links</h6>
                  <ul>
                    <li>
                      <a href="#">Home</a>
                    </li>
                    <li>
                      <a href="#">About Us</a>
                    </li>
                    <li>
                      <a href="#">Services</a>
                    </li>
                    <li>
                      <a href="#">Products</a>
                    </li>
                  </ul>
                </div>
              </div>
              <div className="col-lg-3 col-md-6 col-12">
                <div className="widget">
                  <h6>Social Media</h6>
                  <ul>
                    <li>
                      <a href="#">Facbook</a>
                    </li>
                    <li>
                      <a href="#">Instagram</a>
                    </li>
                    <li>
                      <a href="#">LinkedIn</a>
                    </li>
                    <li>
                      <a href="#">Twitter</a>
                    </li>
                  </ul>
                </div>
              </div>
              <div className="col-lg-3 col-md-6 col-12">
                <div className="widget">
                  <h6>Quick Contact</h6>
                  <ul>
                    <li>
                      <span>Phone : </span>+2 012 345 6789
                    </li>
                    <li>
                      <span>Email : </span>
                      <a href="mailto:info@yourcompany.com"></a>info@yourcompany.com
                    </li>
                    <li>
                      <span>Address : </span>8 Green Tower, Street Name New York City, USA
                    </li>

                  </ul>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div className="space-50"></div>
        <div className="copyright">
          <div className="container">
            <div className="row align-items-center">
              <div className="col-md-4">
                <p>All rights reserved © <a href="#">FPI Ride</a>, 2021</p>
              </div>
              <div className="offset-md-4 col-md-4">
                <ul className="nav justify-content-end">
                  <li className="nav-item">
                    <a className="nav-link" href="#">Terms and Conditions</a>
                  </li>
                  <li className="nav-item">
                    <a className="nav-link" href="#">Privacy Policy</a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </div>
      </footer>

      <script src="assets/js/jquery-3.3.1.min.js"></script>
      <script src="assets/js/popper.min.js"></script>
      <script src="assets/js/bootstrap.min.js"></script>
      <script src="../cdn.linearicons.com/free/1.0.0/svgembedder.min.js"></script>
      <script src="assets/js/slick.min.js"></script>
      <script src="assets/js/waypoints.min.js"></script>
      <script src="assets/js/jquery.counterup.js"></script>
      <script src="assets/js/aos.js"></script>
      <script src="assets/js/lity.min.js"></script>
      <script src="assets/js/main.js"></script>

    </div>

  );
}

export default App;
