const ajax = (link, onready) => {
  const xhr = new XMLHttpRequest()
  xhr.addEventListener('load', () => onready(JSON.parse(xhr.response)))
  xhr.open('get', link)
  xhr.send()
}

const Dollars = ({ amount }) => {
  const integer = Math.floor(amount)
  const fractional = Math.round((amount - integer) * 100)
  const fractionalStr = String(fractional).padStart(2, '0')
  return <>{integer}<sup>{fractionalStr}</sup>$</>
}


class Books extends Component {
  constructor() {
    super()
    this.state = {
      books: window.books,
      selected: -1,
      loading: false
    }
  }
  onSelect = evt => {
    const selected = +evt.target.value
    this.setState({
      selected,
      authors: undefined,
      loading: true
    })
    ajax('/api/authors?book=' + selected, authors => this.setState({ authors, loading: false }))
  }
  render() {
    return (
      <div class="card">
        <div class="card-header">
          <div class="card-title h5">Books</div>
          <div class="card-subtitle text-gray">Select a book to view it's authors</div>
        </div>
        <div class="card-body">

          <div class="form-group">
            <select class="form-select" value={this.state.selected} onChange={this.onSelect}>
              <option value="-1" disabled>Select a book...</option>
              {this.state.books.map(book => <option value={book.id}>{book.title}</option>)}
            </select>
          </div>

          {this.state.loading ? <div class="progress" /> : null}

          {this.state.authors === undefined ? null :
            <table class="table table-striped table-hover">
              <thead><tr><th>Authors</th></tr></thead>
              <tbody>
                {this.state.authors.length
                  ? this.state.authors.map(author => <tr><td>{author.name}</td></tr>)
                  : <tr><td><i>No authors found...</i></td></tr>
                }
              </tbody>
            </table>
          }

        </div>
      </div>
    )
  }
}


class Authors extends Component {
  constructor() {
    super()
    this.state = {
      authors: window.authors,
      selected: -1,
      loading: false
    }
  }
  onSelect = evt => {
    const selected = +evt.target.value
    this.setState({
      selected,
      price: undefined,
      loading: true
    })
    ajax('/api/books?total_price&author=' + selected, price => this.setState({ price, loading: false }))
  }
  selectedAuthor = () => {
    return this.state.authors.find(a => a.id === this.state.selected)
  }
  render() {
    return (
      <div class="card">
        <div class="card-header">
          <div class="card-title h5">Authors</div>
          <div class="card-subtitle text-gray">Select an author to view the combined cost of their books</div>
        </div>
        <div class="card-body">

          <div class="form-group">
            <select class="form-select" value={this.state.selected} onChange={this.onSelect}>
              <option value="-1" disabled>Select an author..</option>
              {this.state.authors.map(author => <option value={author.id}>{author.name}</option>)}
            </select>
          </div>

          {this.state.loading ? <div class="progress" /> : null}

          {this.state.price === undefined ? null : <>
            <b>{this.selectedAuthor().name}</b>
            {' has '}
            <b><Dollars amount={this.state.price} /></b>
            {' worth of books in this catalog.'}
          </>}

        </div>
      </div>
    )
  }
}


const BooksWithoutAuthor = () => {
  const books = window.booksWithoutAuthor
  return (
    <div class="card">
      <div class="card-header">
        <div class="card-title h5">Books without authors</div>
        <div class="card-subtitle text-gray">Consider adding authorship info for these books</div>
      </div>
      <div class="card-body">
        <table class="table table-striped table-hover">
          <thead><tr>
            <th>Title</th>
            <th>Price</th>
          </tr></thead>
          <tbody>
            {books.length
              ? books.map(book => <tr>
                <td>{book.title}</td>
                <td><Dollars amount={book.price} /></td>
              </tr>)
              : <tr><td colspan="2"><i>No books without author found...</i></td></tr>
            }
          </tbody>
        </table>
      </div>
    </div>
  )
}


const App = () => <>
  <Books />
  <Authors />
  <BooksWithoutAuthor />
</>

render(<App />, document.querySelector('#app'))