import React, {Component} from 'react';
import ReactDOM from 'react-dom';
import Header from "./Header";

export default class Ads extends Component {
    constructor(props) {
        super(props);
        console.table(this.props);
        if (this.props.show) console.log(this.props.show);
    }

    render() {
        let ads;
        if (window.location.href !== "http://localhost:3000/myAds")
            ads = JSON.parse(this.props.data).map((x, i) => (
                <div key={i} className="max-w-sm rounded overflow-hidden shadow-lg">
                    <img className="w-full" src={"http://localhost:3000/images/" + x.photo} alt={x.title}/>
                    <div className="px-6 py-4">
                        <div className="font-bold text-xl mb-2">{x.title}</div>
                        <p className="text-gray-700 text-base">
                            {x.description}
                        </p>
                    </div>
                    <div className="px-6 py-4">
                        <span className="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2">
                            {"Price: " + x.price}
                        </span>
                    </div>
                </div>
            ));
        else ads = JSON.parse(this.props.data).map((x, i) => (
            <div key={i} className="max-w-sm rounded overflow-hidden shadow-lg">
                <img className="w-full" src={"http://localhost:3000/images/" + x.photo} alt={x.title}/>
                <div className="px-6 py-4">
                    <div className="font-bold text-xl mb-2">{x.title}</div>
                    <p className="text-gray-700 text-base">
                        {x.description}
                    </p>
                </div>
                <div className="px-6 py-4">
                    <span className="inline-block bg-gray-200 rounded-full px-3 py-1 text-sm font-semibold text-gray-700 mr-2">
                        {"Price: " + x.price}
                    </span>
                    <a href={"http://localhost:3000/deleteAds/" + x.id}>
                        <span className="inline-block cursor-pointer bg-red-800 rounded-full px-3 py-1 text-sm font-semibold text-white mr-2">
                            Delete
                        </span>
                    </a>
                    <a href={"http://localhost:3000/modifyAds/" + x.id}>
                        <span className="inline-block cursor-pointer bg-teal-800 rounded-full px-3 py-1 text-sm font-semibold text-white mr-2">
                            Modify
                        </span>
                    </a>
                </div>
            </div>
        ));
        return (
            <>
                <Header/>
                <div className="container">
                    {
                        ads
                    }
                </div>
            </>
        );
    }
}

if (document.getElementById('ads')) {
    let data = document.getElementById('ads').getAttribute('data');
    ReactDOM.render(<Ads data={data}/>, document.getElementById('ads'));
}
