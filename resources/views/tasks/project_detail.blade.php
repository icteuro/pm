@extends('app')
@section('content')
<!-- main Content start -->
                <div class="row">
                    <div class="col-md-12">
                        <div class="project-button">
                            <button type="button" class="btn btn-default btn-md projects-btn">
                              <a href="#">Overview</a>
                            </button>
                            <button type="button" class="btn btn-default btn-md projects-btn">
                              <a href="#">Task (12/60)</a>
                            </button>
                            <button type="button" class="btn btn-default btn-md projects-btn">
                              <a href="#">Issues (15/168)</a>
                            </button>
                            <button type="button" class="btn btn-default btn-md projects-btn">
                              <a href="#">Team &#38; Schedule</a>
                            </button>
                            <button type="button" class="btn btn-default btn-md projects-btn">
                              <a href="#">File/Note (27)</a>
                            </button>
                            <button type="button" class="btn btn-default btn-md projects-btn">
                              <a href="#">Clarification (2/90)</a>
                            </button>
                            <button type="button" class="btn btn-default btn-md projects-btn">
                              <a href="#">Milestones (35)</a>
                            </button>
                            <button type="button" class="btn btn-default btn-md projects-btn">
                              <a href="#">Discussion (450)</a>
                            </button>
                            <button type="button" class="btn btn-default btn-md projects-btn">
                              <a href="#">Budget &#38; Customer</a>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                         <div class="overview-project-name">
                            <div class="col-md-6">
                                <div class="media border-right">
                                    <div class="media-left media-top">
                                        <a href="#"><img class="media-object" src="img/120x120.png" alt="..."></a>
                                    </div>
                                    <div class="media-body">
                                        <h4 class="media-heading">{{ $project_name }}</h4>
                                        <p>
                                            Tasks: 60 Closed: 48 Ongoing: 4<br>
                                            Issues: 168 Solved: 155<br>
                                            Est Hrs: 2000 Spent Hrs: 2440<br>
                                            Next Mileston: 25/09/2016 (60% Done)<br>
                                            Team: 5 (Project Lead: Ashikur)
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <form>
                                    <div class="form-group">
                                        <textarea rows="3" class="form-control" placeholder="Write Quick Text..."></textarea>
                                    </div>
                                    <div class="form-actions pull-right">
                                        <button class="btn green" type="submit">Save</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
@endsection
