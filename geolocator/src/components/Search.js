import React from 'react';

class Search extends React.Component {
    constructor() {
        super();

        this.state = {
            searchText: '',
            errorMessage: '',
            coordinatesFound: false,
            coordinates: {}
        };

        this.search = this.search.bind(this);
    }

    updateSearchText = (e) => {
        this.setState({
            searchText: e.currentTarget.value,
            errorMessage: '',
            coordinatesFound: false
        })
    }

    search = () => {
        const { searchText } = this.state;

        if (!searchText.length) {
            return;
        }

        fetch(process.env.REACT_APP_API_URL + 'search', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'Accept': 'application/json'
            },
            body: JSON.stringify({ search: searchText })
        })
            .then((response) => response.json())
            .then((jsonResponse) => {
                if (jsonResponse.lat && jsonResponse.lng) {
                    this.setState({
                        coordinates: jsonResponse,
                        coordinatesFound: true,
                        errorMessage: ''
                    });
                } else {
                    this.setState({
                        errorMessage: 'Coordinates not found.',
                    });
                }
        })
            .catch(error => {
                this.setState({
                    errorMessage: error.toString(),
                    coordinatesFound: false,
                    searchText: ''
                });
                console.error('There was an error!', error);
            });
    }

    render() {
        const { searchText, errorMessage, coordinatesFound, coordinates } = this.state;

        return <>
            <h2>Geolocator</h2>
            <div className="search-container">
                <input value={ searchText } onChange={ this.updateSearchText } placeholder="Search for address" />
                <button onClick={ this.search }>Search</button>
            </div>
            { coordinatesFound && <div className="found-container">Lat: { coordinates.lat }, Lng: { coordinates.lng }</div>}
            { errorMessage.length > 0 && <p className="error-message">{ errorMessage }</p> }
        </>;
    }
}

export default Search;