import React, {Component} from 'react';
import ReactDOM from 'react-dom';

export default class Header extends Component {

    constructor(props) {
        super(props);
        this.state = {
            count: "0 New Messages"
        };
        this.getMessageCount();
    }

    getMessageCount(e) {
        fetch("http://localhost:3000/messagesCount", {
            method: "GET",
            headers: {
                "content-type": "application/json"
            }
        }).then((resp) => resp.json())
            .then(val => {
                console.log(val);
                this.setState({ count: val + " New Messages"});
            });
    };

    render() {
        return (
            <nav className="flex items-center justify-between flex-wrap bg-teal-500 p-6">
                <div className="flex items-center flex-shrink-0 text-white mr-6">
                    <svg className="fill-current h-8 w-8 mr-2" width="54" height="54" viewBox="0 0 54 54"
                         xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M13.5 22.1c1.8-7.2 6.3-10.8 13.5-10.8 10.8 0 12.15 8.1 17.55 9.45 3.6.9 6.75-.45 9.45-4.05-1.8 7.2-6.3 10.8-13.5 10.8-10.8 0-12.15-8.1-17.55-9.45-3.6-.9-6.75.45-9.45 4.05zM0 38.3c1.8-7.2 6.3-10.8 13.5-10.8 10.8 0 12.15 8.1 17.55 9.45 3.6.9 6.75-.45 9.45-4.05-1.8 7.2-6.3 10.8-13.5 10.8-10.8 0-12.15-8.1-17.55-9.45-3.6-.9-6.75.45-9.45 4.05z"/>
                    </svg>
                    <a href="http://localhost:3000/home">
                        <span className="font-semibold text-xl tracking-tight">Freeads</span>
                    </a>
                </div>
                <div className="block lg:hidden">
                    <button
                        className="flex items-center px-3 py-2 border rounded text-teal-200 border-teal-400 hover:text-white hover:border-white">
                        <svg className="fill-current h-3 w-3" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <title>Menu</title>
                            <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"/>
                        </svg>
                    </button>
                </div>
                <div className="w-full block flex-grow lg:flex lg:items-center lg:w-auto">
                    <div className="text-sm lg:flex-grow">
                        <a href="/modify"
                           className="block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-white mr-4">
                            Modify information
                        </a>
                        <a href="http://localhost:3000/createAds"
                           className="block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-white mr-4">
                            Post an ad
                        </a>
                        <a href="http://localhost:3000/myAds"
                           className="block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-white mr-4">
                            My Ads
                        </a>
                        <a href="http://localhost:3000/messages"
                           className="block mt-4 lg:inline-block lg:mt-0 text-teal-200 hover:text-white">
                           { this.state.count }
                        </a>
                    </div>
                    <form className="mb-4 w-full md:mb-0 md:w-1/4" method="GET" action="http://localhost:3000/searchAds">
                        <label className="hidden" htmlFor="search-form">Search</label>
                        <input className="text-teal-800 border-2 focus:border-teal-800 p-2 rounded-lg shadow-inner w-full"
                            placeholder="Search" name="search" type="text"/>
                            <button className="hidden">Submit</button>
                    </form>
                    <div>
                        <a href="http://localhost:3000/logout" className="inline-block text-sm px-4 py-2 leading-none border rounded text-white border-white hover:border-transparent hover:text-teal-500 hover:bg-white mt-4 lg:mt-0">
                            Logout
                        </a>
                    </div>
                </div>
            </nav>
        );
    }
}
//
// if (document.getElementById('header')) {
//     ReactDOM.render(<Header/>, document.getElementById('header'));
// }
