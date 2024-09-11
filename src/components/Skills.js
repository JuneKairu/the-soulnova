import Carousel from 'react-multi-carousel';
import 'react-multi-carousel/lib/styles.css';
import arrow1 from "../assets/img/arrow1.svg";
import arrow2 from "../assets/img/arrow2.svg";

export const Skills = () => {
  const responsive = {
    Desktop: {

      breakpoint: { max: 4000, min: 3000 },
      items: 5
    },
    Laptop: {
      breakpoint: { max: 3000, min: 1024 },
      items: 3
    },
    Tablet: {
      breakpoint: { max: 1024, min: 464 },
      items: 2
    },
    Mobile: {
      breakpoint: { max: 464, min: 0 },
      items: 1
    }
  };

  return (
    <section className="skill" id="skills">
        <div className="container">
            <div className="row">
                <div className="col-12">
                    <div className="skill-bx wow zoomIn">
                        <h2>Skills</h2>
                        <p>Grades doesn't define me.<br></br> Introducing my skills.</p>
                        <Carousel responsive={responsive} infinite={true} className="owl-carousel owl-theme skill-slider">
                            <div className="item">
                                <h1>50%</h1>
                                <h5>Web Designing</h5>
                            </div>
                            <div className="item">
                                <h1>80%</h1>
                                <h5>Illustrating</h5>
                            </div>
                            <div className="item">
                                <h1>30%</h1>
                                <h5>Programming</h5>
                            </div>
                            <div className="item">
                                <h1>70%</h1>
                                <h5>Gaming</h5>
                            </div>
                        </Carousel>
                    </div>
                </div>
            </div>
        </div>
    </section>
  )
}
