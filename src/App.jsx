//import Link from react router dom
import { Link } from "react-router-dom";

//import routes
import Routes from './routes';

export default function App() {

  return (
    <>
      <div>
        <nav className="navbar navbar-expand-lg bg-dark" data-bs-theme="dark">
          <div className="container">
            <Link to="/" className="navbar-brand">HOME</Link>
            <button
              className="navbar-toggler"
              type="button"
              data-bs-toggle="collapse"
              data-bs-target="#navbarSupportedContent"
              aria-controls="navbarSupportedContent"
              aria-expanded="false"
              aria-label="Toggle navigation"
            >
              <span className="navbar-toggler-icon"></span>
            </button>
            <div className="collapse navbar-collapse" id="navbarSupportedContent">
              <ul className="navbar-nav me-auto mb-2 mb-lg-0">
                <li className="nav-item">
                  <Link to="/posts" className="nav-link active" aria-current="page">POSTS</Link>
                </li>
              </ul>
              <ul className="navbar-nav ms-auto mb-2 mb-lg-0" role="search">
                <a
                  href="https://santrikoding.com"
                  target="_blank"
                  className="btn btn-success"
                  >SANTRIKODING.COM</a
                >
              </ul>
            </div>
          </div>
        </nav>
      </div>

      <Routes />

    </>
  )
  
}